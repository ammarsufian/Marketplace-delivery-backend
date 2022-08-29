<?php

namespace Database\Factories;

use App\Domains\OrderManagement\Models\PromoCode;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PromoCodeFactory extends Factory
{
    protected $model = PromoCode::class;

    /**
     * Define the model's default state.
     *
     * @return array
     *
     */
    public function definition()
    {
        return [
            'promo_code' => $this->faker->name,
            'value' => $this->faker->randomDigit(10),
            'type' => $this->faker->randomElement(array_keys(PromoCode::PROMO_CODE_TYPE)),
            'is_active' => $this->faker->boolean,
            'start_datetime' => Carbon::now()->subDay(),
            'end_datetime' => Carbon::now()->addDay(),
            'counter' => $this->faker->randomDigit(2)
        ];
    }

    public function ofType(string $type):PromoCodeFactory
    {
        return $this->state(function (array $attributes)use($type){
            return [
                'type' => $type
            ];
        });
    }
    public function durationBetween(Carbon $startDateTime,Carbon $endDateTime):PromoCodeFactory
    {
        return $this->state(function (array $attributes)use($startDateTime,$endDateTime){
            return [
                'start_datetime' => $startDateTime,
                'end_datetime' => $endDateTime
            ];
        });
    }

    public function ofCounter(int $counter):PromoCodeFactory
    {
        return $this->state(function (array $attributes) use($counter){
            return [
                'counter' => $counter
            ];
        });
    }
}
