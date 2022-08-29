<?php

namespace Database\Factories;

use App\Domains\AccountManagement\Models\Branch;
use App\Domains\OrderManagement\Models\Cart;
use App\Domains\OrderManagement\Models\CartItem;
use App\Domains\ProductManagement\Models\EntityProduct;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

class CartItemFactory extends Factory
{
    protected $model = CartItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     *
     */
    public function definition()
    {
        $buyable = EntityProduct::factory()->create();
        return [
            'cart_id' => Cart::factory()->create()->id,
            'branch_id' => Branch::factory()->create()->id,
            'buyable_id' => $buyable->id,
            'buyable_type' => class_basename($buyable),
            'quantity' => $this->faker->randomDigit(2),
        ];
    }

    public function ofCart(Cart $cart): CartItemFactory
    {
        return $this->state(function ($attributes) use ($cart) {
            return [
                'cart_id' => $cart->id,
            ];
        });
    }

    public function ofBranch(Branch $branch): CartItemFactory
    {
        return $this->state(function ($attributes) use ($branch) {
            return [
                'branch_id' => $branch->id,
            ];
        });
    }

    public function ofBuyable(Model $model): CartItemFactory
    {
        return $this->state(function ($attributes) use ($model) {
            return [
                'buyable_id' => $model->id,
                'buyable_type' => class_basename($model),
            ];
        });
    }
}
