<?php

namespace Database\Factories;

use App\Domains\AccountManagement\Models\Branch;
use App\Domains\ProductManagement\Models\EntityProduct;
use App\Domains\ProductManagement\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntityProductFactory extends Factory
{
    protected $model = EntityProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::factory()->create()->id,
            'branch_id' => Branch::factory()->create()->id,
            'unit_price' => $this->faker->randomDigit(2),
            'vat' => $this->faker->randomDigit(2),
            'discount' => $this->faker->randomDigit(2),
            'status' => $this->faker->randomElement(EntityProduct::ENTITY_PRODUCT_STATUS),
        ];
    }

    public function ofStatus(string $status): EntityProductFactory
    {
        return $this->state(function (array $attributes) use ($status) {
            return [
                'status' => $status
            ];
        });
    }

    public function ofBranch(Branch $branch): EntityProductFactory
    {
        return $this->state(function (array $attributes) use ($branch) {
            return [
                'branch_id' => $branch->id
            ];
        });
    }

    public function ofProduct(Product $product): EntityProductFactory
    {
        return $this->state(function (array $attributes) use ($product) {
            return [
                'product_id' => $product->id,
            ];
        });
    }
}
