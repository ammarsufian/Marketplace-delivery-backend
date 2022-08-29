<?php

namespace Database\Factories;

use App\Domains\AccountManagement\Models\Branch;
use App\Domains\Authentication\Models\User;
use App\Domains\OrderManagement\Models\Cart;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    protected $model = Cart::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create()->id,
            'branch_id' => Branch::factory()->create()->id,
        ];
    }

    public function ofUser(User $user): CartFactory
    {
        return $this->state(function ($attributes) use ($user) {
            return [
                'user_id' => $user->id,
            ];
        });
    }

    public function ofBranch(Branch $branch): CartFactory
    {
        return $this->state(function ($attributes) use ($branch) {
            return [
                'branch_id' => $branch->id,
            ];
        });
    }
}
