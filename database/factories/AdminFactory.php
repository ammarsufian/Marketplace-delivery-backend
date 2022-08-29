<?php

namespace Database\Factories;

use App\Domains\Authentication\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class AdminFactory extends Factory
{
    protected $model =Admin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition():array
    {
        return [
            'name'=> $this->faker->name,
            'password' => Hash::make('password'),
            'email' => 'admin@cova-app.com',
        ];
    }
}
