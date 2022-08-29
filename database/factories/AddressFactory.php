<?php

namespace Database\Factories;

use App\Domains\AccountManagement\Models\Address;
use App\Domains\ApplicationManagement\Models\City;
use App\Domains\Authentication\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create()->id,
            'type' => $this->faker->text,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'is_default' => $this->faker->boolean,
            'city_id' => City::factory()->create()->id
        ];
    }

    public function ofUser(User $user): AddressFactory
    {
        return $this->state(function ($attributes) use ($user) {
            return [
                'user_id' => $user->id
            ];
        });
    }

    public function ofCity(City $city): AddressFactory
    {
        return $this->state(function ($attributes) use ($city) {
            return [
                'city_id' => $city->id
            ];
        });
    }
    public function ofLocation($latitude,$longitude): AddressFactory
    {
        return $this->state(function ($attributes) use ($longitude,$latitude) {
            return [
                'latitude' => $latitude,
                'longitude' => $longitude
            ];
        });
    }
}
