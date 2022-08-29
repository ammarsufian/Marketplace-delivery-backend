<?php

namespace Database\Factories;

use App\Domains\Authentication\Models\User;
use App\Domains\OrderManagement\Models\Order;
use App\Domains\AccountManagement\Models\Branch;
use App\Domains\AccountManagement\Models\Address;
use App\Domains\OrderManagement\Models\PromoCode;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'total' => $this->faker->randomDigit(),
            'subtotal'=> $this->faker->randomDigit(),
            'vat'=> $this->faker->randomDigit(),
            'delivery' => $this->faker->randomDigit(),
            'address_id' => Address::factory()->create()->id,
            'promo_code_id' => PromoCode::factory()->create()->id,
            'branch_id' => Branch::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
            'discount' => 0,
            'status' => Order::PENDING_ORDER_STATUS,
            'created_at' => $this->faker->dateTimeBetween('-25 days', 'now'),
        ];
    }
}
