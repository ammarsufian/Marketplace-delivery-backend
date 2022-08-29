<?php

namespace Database\Factories;

use App\Domains\AccountManagement\Models\Branch;
use App\Domains\Shipment\Models\ShipmentHandler;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShipmentHandlerFactory extends Factory
{
    protected $model = ShipmentHandler::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'type' => $this->faker->randomElement(Branch::BRANCH_TYPES),
            'is_active' => $this->faker->boolean
        ];
    }

    public function WithName(string $name)
    {
        return $this->state(function ($attributes) use ($name) {
            return [
                'name' => $name
            ];
        });
    }

    public function active()
    {
        return $this->state(function ($attributes) {
            return [
                'is_active' => true,
            ];
        });
    }
}
