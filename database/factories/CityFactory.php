<?php

namespace Database\Factories;

use App\Domains\ApplicationManagement\Models\City;
use App\Domains\ApplicationManagement\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    protected $model = City::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition():array
    {
        return [
            'name' => ['en'=>$this->faker->name,'ar'=> $this->faker->name],
            'country_id' => Country::factory()->create()->id,
        ];
    }
}
