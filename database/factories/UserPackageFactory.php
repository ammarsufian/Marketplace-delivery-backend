<?php

namespace Database\Factories;

use App\Domains\Authentication\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domains\ApplicationManagement\Models\Package;
use App\Domains\ApplicationManagement\Models\UserPackage;

class UserPackageFactory extends Factory
{
    protected $model = UserPackage::class;
    /**
     * Define the model's default state.
     *$table->unsignedInteger('covered_order_counts');
     *$table->timestamp('expiration_date');
     * @return array
     */
    public function definition()
    {
        $package = Package::factory()->create();
        return [
        'package_id' => $package->id,
        'covered_order_counts'=> $package->covered_order_counts,
        'expiration_date' => now()->addMonths($package->covered_month_counts),
        'user_id' => User::factory()->create()->id,
        ];
    }
}
