<?php

namespace Database\Factories;

use App\Domains\OrderManagement\Models\CartItem;
use App\Domains\OrderManagement\Models\CartItemVariant;
use App\Domains\ProductManagement\Models\Variant;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartItemVariantFactory extends Factory
{
    protected $model = CartItemVariant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cart_item_id' => CartItem::factory()->create()->id,
            'variant_id' => Variant::factory()->create()->id,
            'price' => $this->faker->randomDigit(),
        ];
    }
}
