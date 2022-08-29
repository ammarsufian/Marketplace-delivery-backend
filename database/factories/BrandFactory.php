<?php

namespace Database\Factories;

use App\Domains\AccountManagement\Models\Brand;
use App\Domains\ApplicationManagement\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    protected $model = Brand::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => ['en' => $this->faker->name, 'ar' => $this->faker->name],
            'description' => $this->faker->text,
            'status' => $this->faker->boolean,
            'country_id' => Country::factory()->create()->id
        ];
    }
}
