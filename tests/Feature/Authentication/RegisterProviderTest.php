<?php

namespace Tests\Feature\Authentication;

use Tests\FlowTestCase;
use Illuminate\Support\Facades\Hash;
use App\Domains\Authentication\Models\User;


class RegisterProviderTest extends FlowTestCase
{

    /** @test */
    public function it_can_not_register_provider_with_empty_data()
    {
        $this->registerProvider([])->assertStatus(422);
    }

    /** @test */
    public function it_can_not_register_provider_with_invalid_mobile_number()
    {
        $user= User::factory()->create();
        $this->registerProvider([
            'mobile_number' => $user->mobile_number,
            'password' => '123456789',
            'password_confirmation' => '123456789'
            ])->assertStatus(422);
    }

    /** @test */
    public function it_can_not_register_provider_with_password_not_match_confirmation()
    {
        $this->registerProvider([
            'mobile_number' => $this->faker->phoneNumber,
            'password' => $this->faker->password,
            'password_confirmation' => $this->faker->password,
            ])->assertStatus(422);
    }

    /** @test */
    public function it_can_not_register_provider_with_password_leas_six_characters()
    {
        $password= $this->faker->randomNumber(5).'';
        $this->registerProvider([
            'mobile_number' => $this->faker->phoneNumber,
            'password' => $password,
            'password_confirmation' => $password,
        ])->assertStatus(422);
    }

    /** @test */
    public function it_should_register_a_provider()
    {
        $this->registerProvider([
            'mobile_number' => $this->faker->phoneNumber,
            'password' => '123456',
            'password_confirmation' => '123456',
        ])->assertStatus(201);
    }

}
