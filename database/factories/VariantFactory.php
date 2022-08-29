<?php

namespace Database\Factories;

use App\Domains\ProductManagement\Models\GroupVariant;
use App\Domains\ProductManagement\Models\Variant;
use Illuminate\Database\Eloquent\Factories\Factory;

class VariantFactory extends Factory
{
    protected $model = Variant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => ['en' => $this->faker->name, 'ar' => $this->faker->name],
            'group_id' => GroupVariant::factory()->create()->id,
        ];
    }
}
