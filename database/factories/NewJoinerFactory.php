<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domains\AccountManagement\Models\NewJoiner;

class NewJoinerFactory extends Factory
{
    protected $model = NewJoiner::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'mobile_number' => $this->faker->phoneNumber,
            'type' => $this->faker->randomElement(['partner', 'rider']),
            'city_id' => $this->faker->numberBetween(1, 4),
        ];
    }
}
