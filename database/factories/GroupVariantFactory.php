<?php

namespace Database\Factories;

use App\Domains\ProductManagement\Models\GroupVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupVariantFactory extends Factory
{
    protected $model = GroupVariant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->name,
            'is_required' => $this->faker->boolean,
        ];
    }
}
