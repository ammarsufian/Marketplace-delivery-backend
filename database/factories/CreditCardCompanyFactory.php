<?php

namespace Database\Factories;

use App\Domains\Transaction\Models\CreditCardCompany;
use Illuminate\Database\Eloquent\Factories\Factory;

class CreditCardCompanyFactory extends Factory
{

    protected $model = CreditCardCompany::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition():array
    {
        return [
            'name' => ['en' => $this->faker->name , 'ar' => $this->faker->name],
        ];
    }
}
