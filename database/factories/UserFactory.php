<?php

namespace Database\Factories;

use App\Domains\ApplicationManagement\Models\Country;
use App\Domains\Authentication\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use function App\Helpers\mobile;

class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'mobile_number' => '798135749',// mobile($this->faker->phoneNumber),
            'country_id' => Country::factory()->create()->id,
            'is_active' => true,
            'referral_key' => Str::random(10),
        ];
    }
}
