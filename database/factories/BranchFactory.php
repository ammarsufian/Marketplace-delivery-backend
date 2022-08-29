<?php

namespace Database\Factories;

use App\Domains\AccountManagement\Models\Branch;
use App\Domains\AccountManagement\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class BranchFactory extends Factory
{
    protected $model = Branch::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'brand_id' => Brand::factory()->create()->id,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'status' => Branch::ACTIVE_STATUS_BRANCH,
            'is_main_branch' => $this->faker->boolean,
            'delivery_time' => $this->faker->randomNumber(),
            'type' => $this->faker->randomElement(Branch::BRANCH_TYPES),
            'schedule' => [
                'saturday' => ['9:00-23:00'],
                'sunday' => ['9:00-23:00'],
                'monday' => ['9:00-23:00'],
                'tuesday' => ['9:00-23:00'],
                'wednesday' => ['9:00-23:00'],
                'thursday' => ['9:00-23:00'],
                'friday' => ['9:00-23:00']
            ],
            'contact_us' => [
                'mobile_number' => $this->faker->phoneNumber,
                'email' => $this->faker->email
            ]
        ];
    }

    public function ofType($type): BranchFactory
    {
        return $this->state(function ($attributes) use ($type) {
            return [
                'type' => $type
            ];
        });
    }

    public function ofPosition($latitude, $longitude): BranchFactory
    {
        return $this->state(function ($attributes) use ($latitude, $longitude) {
            return [
                'latitude' => $latitude,
                'longitude' => $longitude
            ];
        });
    }
}
