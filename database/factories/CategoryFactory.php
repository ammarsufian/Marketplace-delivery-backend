<?php

namespace Database\Factories;

use App\Domains\ApplicationManagement\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => ['en' => $this->faker->name, 'ar' => $this->faker->name],
            'is_shown_on_home_page' => $this->faker->boolean
        ];
    }

    public function WithShownOnHomePage($show = true): CategoryFactory
    {
        return $this->state(function (array $attributes) use ($show) {
            return [
                'is_shown_on_home_page' => $show
            ];
        });
    }
}
