<?php

namespace App\Console\Commands;

use App\Domains\AccountManagement\Models\Address;
use App\Domains\AccountManagement\Models\Branch;
use App\Domains\AccountManagement\Models\Brand;
use App\Domains\AccountManagement\Models\Legacy\AddressLegacy;
use App\Domains\AccountManagement\Models\Legacy\BranchLegacy;
use App\Domains\AccountManagement\Models\Legacy\BrandLegacy;
use App\Domains\AccountManagement\Models\Legacy\UserLegacy;
use App\Domains\ApplicationManagement\Models\Category;
use App\Domains\ApplicationManagement\Models\City;
use App\Domains\ApplicationManagement\Models\Country;
use App\Domains\ApplicationManagement\Models\Legacy\CategoryLegacy;
use App\Domains\ApplicationManagement\Models\Legacy\CityLegacy;
use App\Domains\ApplicationManagement\Models\Legacy\LegacyMedia;
use App\Domains\Authentication\Models\User;
use App\Domains\OrderManagement\Models\Legacy\OrderLegacy;
use App\Domains\OrderManagement\Models\Order;
use App\Domains\ProductManagement\Models\EntityProduct;
use App\Domains\ProductManagement\Models\GroupVariant;
use App\Domains\ProductManagement\Models\Legacy\LegacyAdditionalItem;
use App\Domains\ProductManagement\Models\Legacy\LegacyEntityProduct;
use App\Domains\ProductManagement\Models\Legacy\LegacyProduct;
use App\Domains\ProductManagement\Models\Product;
use App\Domains\ProductManagement\Models\Variant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class syncAccountDataFromLegacyDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:account';
    protected $lastIdAdditionalItem = 0;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Account management data from legacy database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->models = [
            'branch' => Branch::class,
            'brand' => Brand::class,
            'user' => User::class,
            'address' => Address::class,
            'product' => Product::class,
        ];
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ini_set('memory_limit', '-1');
        $selectedModel = $this->choice('Please select tables to sync it ', $this->models);

        if ($selectedModel == 'user') {
            return $this->syncUserData();
        } elseif ($selectedModel == 'brand') {
            return $this->syncBrand();
        } elseif ($selectedModel == 'branch') {
            return $this->syncBranch();
        } elseif ($selectedModel == 'address') {
            return $this->syncAddress();
        } elseif ($selectedModel == 'product') {
            $this->syncCategories();
            $this->syncProductModelData();
            $this->syncAdditionalItem();
            $this->syncVariants();
            $this->syncEntityProductData();
        }

        return 'Done';
    }

    protected function syncUserData()
    {
        UserLegacy::whereIn('role', ['application', 'provider', 'super-admin', 'manager'])
            ->chunk(1000, function ($users) {
                $users->each(function (UserLegacy $userLegacy) {
                    $user = User::updateOrCreate(['id' => $userLegacy->id], [
                        'id' => $userLegacy->id,
                        'name' => $userLegacy->name,
                        'mobile_number' => preg_match('/[0-9]/ui', $userLegacy->mobile_number) ? '0' . substr(preg_replace('/\s+/', '', $userLegacy->mobile_number), -9) : '0000000000',
                        'email' => $userLegacy->email,
                        'password' => $userLegacy->password,
                        'created_at' => $userLegacy->created_at,
                    ]);
                    $user->assignRole($userLegacy->role);
                    echo $user;
                });
            });

        echo 'completed';
        return 'Done';
    }

    protected function syncBrand()
    {
        BrandLegacy::all()->each(function (BrandLegacy $brandLegacy) {
            $brand = Brand::create([
                'id' => $brandLegacy->id,
                'name' => ['en' => $brandLegacy->name, 'ar' => $brandLegacy->name],
                'description' => $brandLegacy->description,
                'status' => $brandLegacy->status,
                'country_id' => Country::SAUDIA_COUNTRY_ID,
                'created_at' => $brandLegacy->created_at,
                'updated_at' => $brandLegacy->updated_at,
            ]);
            $image = LegacyMedia::query()->where('model_id', $brandLegacy->id)
                ->where('model_type', 'Branch')->first();
            if (!empty($image)) {
                $image->collection_name = 'logo';
                $image->model_type = Brand::class;
                $image->generated_conversions = [];
                Media::query()->create($image->toArray());
            }
        });
        return 'Done';
    }

    protected function syncBranch()
    {
        BranchLegacy::chunk(1000, function ($branches) {
            $branches->each(function ($legacyBranch) {
                $branch = Branch::updateOrCreate(['id' => $legacyBranch->id], [
                    'id' => $legacyBranch->id,
                    'latitude' => $legacyBranch->latitude,
                    'longitude' => $legacyBranch->longitude,
                    'brand_id' => $legacyBranch->brand_id,
                    'created_at' => $legacyBranch->created_at,
                    'schedule' => json_decode($legacyBranch->working_times),
                    'status' => $legacyBranch->status,
                    'type' => $legacyBranch->is_cafe ? 'cafe' : 'roaster',
                    'delivery_time' => $legacyBranch->estimate_delivery_time,
                ]);

                if ($legacyBranch->manager_id && $legacyBranch->id != 218)
                    $branch->owners()->sync($legacyBranch->manager_id);
            });
        });

        return 'Done';
    }

    protected function syncAddress()
    {
        CityLegacy::query()->selectRaw("id,JSON_OBJECT('en', name_en, 'ar', name_ar) as name ,1 as country_id")->chunk(100, function ($data) {
            return City::query()->insert($data->toArray());
        });

        AddressLegacy::chunk(1000, function ($addresses) {
            $addresses->map(function (AddressLegacy $addressLegacy) {
                if (!$addressLegacy->user)
                    return null;

                Address::updateOrCreate(['id' => $addressLegacy->id], [
                    'id' => $addressLegacy->id,
                    'latitude' => $addressLegacy->latitude,
                    'longitude' => $addressLegacy->longitude,
                    'is_default' => $addressLegacy->is_default,
                    'city_id' => $addressLegacy->city_id,
                    'type' => $addressLegacy->type === 'work' ? 'work' : 'home',
                    'user_id' => $addressLegacy->user_id,
                    'created_at' => $addressLegacy->created_at
                ]);
            });
        });
        return 'Done';
    }

    public function syncCategories()
    {
        CategoryLegacy::chunk(100, function ($categories) {
            $categories->map(function (CategoryLegacy $categoryLegacy) {
                Category::query()->updateOrCreate(['id' => $categoryLegacy->id], [
                    'name' => $categoryLegacy->name,
                    'parent_category_id' => $categoryLegacy->parent_category_id,
                    'type' => 'cafe',
                ]);
            });
        });
        echo 'Sync Categories completed successfully';
    }

    public function syncProductModelData()
    {
        LegacyProduct::get()->map(function (LegacyProduct $legacyProduct) {
            Product::query()->updateOrCreate(['id' => $legacyProduct->id], $legacyProduct->toArray());
        });

        echo 'Sync Products completed successfully';
        return 0;
    }

    public function syncAdditionalItem()
    {
        $additionalGroup = GroupVariant::create([
            'name' => [
                'en' => 'Additional Item',
                'ar' => 'Additional Item',
            ],
            'type' => 'additionalItem',
        ]);

        LegacyAdditionalItem::chunk(100, function ($additions) use ($additionalGroup) {
            $additions->each(function ($addition) use ($additionalGroup) {
                $variant = Variant::create([
                    'id' => $addition->id,
                    'name' => ['en' => $addition->name, 'ar' => $addition->name],
                    'group_id' => $additionalGroup->id
                ]);
                $this->lastIdAdditionalItem = $variant->id;
            });
        });
    }

    public function syncVariants()
    {
        $variantGroup = GroupVariant::create([
            'name' => [
                'en' => 'Variant Item',
                'ar' => 'Variant Item',
            ],
            'type' => 'Variants',

        ]);

        LegacyAdditionalItem::chunk(100, function ($variants) use ($variantGroup) {
            $variants->each(function ($variant) use ($variantGroup) {
                $variant = Variant::create([
                    'id' => $variant->id + $this->lastIdAdditionalItem,
                    'name' => ['en' => $variant->name, 'ar' => $variant->name],
                    'group_id' => $variantGroup->id
                ]);
            });
        });
    }

    public function syncEntityProductData()
    {
        LegacyEntityProduct::whereNotNull('product_model_id')->chunk(1000, function ($entityProducts) {
            $entityProducts->map(function (LegacyEntityProduct $legacyEntityProduct) {
                $legacyEntityProduct->brand->branches->map(function (BranchLegacy $branchLegacy) use ($legacyEntityProduct) {
                    $entityProduct = EntityProduct::create([
                        'unit_price' => $legacyEntityProduct->price,
                        'branch_id' => $branchLegacy->id,
                        'status' => $legacyEntityProduct->is_available ? 'active' : 'in-active',
                        'created_at' => $legacyEntityProduct->created_at,
                        'updated_at' => $legacyEntityProduct->updated_at,
                        'product_id' => $legacyEntityProduct->product_model_id,
                        'vat' => 0,
                        'discount' => 0,
                    ]);
                    $this->variantsHandler($entityProduct, $legacyEntityProduct);
                });
            });
        });


        echo 'Sync Entity Product completed successfully';
        return 0;
    }

    public function variantsHandler(EntityProduct $entityProduct, LegacyEntityProduct $legacyEntityProduct)
    {
        $legacyEntityProduct->additional_items
            ->map(function ($additionalItem) use ($entityProduct) {
                $entityProduct->variants()->attach($additionalItem->id, ['price' => $additionalItem->pivot->price]);
            });

        $legacyEntityProduct->variants
            ->map(function ($variant) use ($entityProduct) {
                $entityProduct->variants()->attach($variant->id + $this->lastIdAdditionalItem, ['price' => $variant->pivot->price]);
            });
    }

}
