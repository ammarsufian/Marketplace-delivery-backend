<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domains\OrderManagement\Models\OrderCancelReason;

class OrderCancelReasonFactory extends Factory
{
    protected $model =OrderCancelReason::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return [
            'reason'=>[
                'en'=>$this->faker->sentence,
                'ar'=>$this->faker->sentence
            ]
        ];
    }
}
