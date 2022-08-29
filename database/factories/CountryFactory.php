<?php

namespace Database\Factories;

use App\Domains\ApplicationManagement\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    protected $model = Country::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => ['en' => $this->faker->countryCode]
        ];
    }
}
