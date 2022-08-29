<?php

namespace Database\Factories;

use App\Domains\AccountManagement\Models\Branch;
use App\Domains\OrderManagement\Models\Cart;
use App\Domains\OrderManagement\Models\CartItem;
use App\Domains\OrderManagement\Models\Order;
use App\Domains\OrderManagement\Models\OrderItem;
use App\Domains\ProductManagement\Models\EntityProduct;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

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
            'order_id' => Order::factory()->create()->id,
            'buyable_id' => $buyable->id,
            'buyable_type' => class_basename($buyable),
            'quantity' => $this->faker->randomDigit(2),
            'total' => $this->faker->randomFloat(),
            'vat' => $this->faker->randomDigit(2),
            'discount' => $this->faker->randomDigit(2),
            'unit_price' => $this->faker->randomFloat(),
        ];
    }

    public function ofCart(Cart $cart): OrderItemFactory
    {
        return $this->state(function ($attributes) use ($cart) {
            return [
                'cart_id' => $cart->id,
            ];
        });
    }

    public function ofBranch(Branch $branch): OrderItemFactory
    {
        return $this->state(function ($attributes) use ($branch) {
            return [
                'branch_id' => $branch->id,
            ];
        });
    }

    public function ofBuyable(Model $model): OrderItemFactory
    {
        return $this->state(function ($attributes) use ($model) {
            return [
                'buyable_id' => $model->id,
                'buyable_type' => class_basename($model),
            ];
        });
    }
}
