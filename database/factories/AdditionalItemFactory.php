<?php

namespace Database\Factories;

use App\Domains\ProductManagement\Models\AdditionalItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdditionalItemFactory extends Factory
{

    protected $model = AdditionalItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => ['en' => $this->faker->name, 'ar' => $this->faker->name]
        ];
    }
}
