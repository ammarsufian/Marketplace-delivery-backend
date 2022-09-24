<?php

namespace Database\Factories;

use App\Domains\AccountManagement\Models\Branch;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domains\ApplicationManagement\Models\Package;

class PackageFactory extends Factory
{
    protected $model = Package::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => [
                'en' => $this->faker->words(2, true),
                'ar' => $this->faker->words(2, true),
            ],
            'description' => [
                'en' => $this->faker->paragraphs(),
                'ar' => $this->faker->paragraphs(),
            ],
            'price' => $this->faker->randomNumber(2),
            'covered_order_counts' => $this->faker->randomNumber(2),
            'covered_month_counts' => $this->faker->randomNumber(1),
            'is_active' => $this->faker->boolean,
            'branch_id' => Branch::factory()->create()->id,
        ];
    }

    public function active(): self
    {
        return $this->state(function (array $attribute) {
            return [
                'is_active' => true
            ];
        });
    }

    public function inactive(): self
    {
        return $this->state(function (array $attribute) {
            return [
                'is_active' => false
            ];
        });
    }
}
