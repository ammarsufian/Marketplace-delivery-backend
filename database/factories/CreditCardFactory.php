<?php

namespace Database\Factories;

use App\Domains\Transaction\Models\CreditCard;
use App\Domains\Transaction\Models\CreditCardCompany;
use App\Domains\Authentication\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Crypt;
class CreditCardFactory extends Factory
{

    protected $model = CreditCard::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'card_number' => $this->faker->creditCardNumber,
            'expiration_date' => Carbon::now(),
            'cvv' => $this->faker->randomNumber(3),
            'company_id' => CreditCardCompany::inRandomOrder()->first()->id,
            'user_id' => User::factory()->create()->id,
        ];
    }

    public function ofUser(User $user):self
    {
        return $this->state(function (array $attributes) use($user){
           return [
               'user_id' => $user->id
           ];
        });
    }

    public function ofCardNumber(string $cardNumber):self
    {
        return $this->state(function (array $attributes) use($cardNumber){
            return [
                'number' => $cardNumber
            ];
        });
    }
}

