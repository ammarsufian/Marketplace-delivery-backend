<?php

namespace Database\Factories;

use App\Domains\AccountManagement\Models\ContactUs;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactUsFactory extends Factory
{
    protected $model = ContactUs::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'message' => $this->faker->text,
        ];
    }
}
