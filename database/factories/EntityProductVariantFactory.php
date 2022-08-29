<?php

namespace Database\Factories;

use App\Domains\ProductManagement\Models\EntityProduct;
use App\Domains\ProductManagement\Models\EntityProductVariants;
use App\Domains\ProductManagement\Models\Variant;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntityProductVariantFactory extends Factory
{
    protected $model = EntityProductVariants::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'entity_product_id' => EntityProduct::factory()->create()->id,
            'variant_id' => Variant::factory()->create()->id,
            'price' => $this->faker->randomFloat(3,1,50),
        ];
    }

    public function ofEntityProduct(EntityProduct $entityProduct):EntityProductVariantFactory
    {
        return $this->state(function (array $attributes)use($entityProduct) {
            return [
                'entity_product_id' => $entityProduct->id,
            ];
        });
    }
}
