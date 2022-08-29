<?php

namespace Database\Factories;

use App\Domains\Transaction\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentMethodFactory extends Factory
{
    protected $model = PaymentMethod::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => ['en'=>$this->faker->name,'ar'=>$this->faker->name],
            'is_active' => $this->faker->boolean,
        ];
    }

    public function active():PaymentMethodFactory
    {
        return $this->state(function (array $attributes){
           return [
               'is_active' => true
           ];
        });
    }
    public function notActive():PaymentMethodFactory
    {
        return $this->state(function (array $attributes){
            return [
                'is_active' => false
            ];
        });
    }
}
