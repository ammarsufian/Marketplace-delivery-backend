<?php

namespace Database\Factories;

use App\Domains\Authentication\Models\User;
use App\Domains\Transaction\Models\UserTransaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserTransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = UserTransaction::class;
    public function definition()
    {
        return [
            'user_id' => User::factory()->create()->id,
            'reason' => UserTransaction::POINTS_REASON,
            'amount' => UserTransaction::POINTS_AMOUNT,
            'status' => UserTransaction::POINTS_STATUS_PENDING,
        ];
    }
}
