<?php

namespace Database\Factories;

use App\Domains\ProductManagement\Models\AdditionalItem;
use App\Domains\ProductManagement\Models\EntityProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntityProductAdditionalItemFactory extends Factory
{
    protected $model = AdditionalItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'entity_product_id' => EntityProduct::factory()->create()->id,
            'additional_item_id' => AdditionalItem::factory()->create()->id,
            'price' => $this->faker->randomFloat(3,1,50)
        ];
    }
}
