<?php

namespace Tests\Feature\Authentication;

use App\Domains\Authentication\Models\User;
use Tests\FlowTestCase;

class RegisterTest extends FlowTestCase
{
    /** @test */
    public function it_should_failed_when_send_empty_data()
    {
        $this->register([])->assertStatus(422);
    }

    /** @test */
    public function it_should_failed_when_send_exists_mobile_number()
    {
        $user = User::factory()->create();
        $this->register([
            'mobile_number' => $user->mobile_number
        ])->assertJsonFragment([
            "mobile_number" => [
                "Mobile Number already exists"
            ]
        ])->assertStatus(422);
    }

    /** @test */
    public function it_should_pass_to_register_new_user_when_send_unique_data()
    {
        $mobile_number = $this->faker->phoneNumber;
        $this->register([
            'mobile_number' => $mobile_number
        ])->assertSee('access_token')
            ->assertStatus(201);

        $this->assertEquals(substr(str_replace('-', '', $mobile_number), -9), User::first()->mobile_number);
    }

    /** @test */
    public function it_should_failed_to_register_same_mobile_number_with_different_keys()
    {
        $mobile_number = User::factory()->create()->mobile_number;
        $this->register([
            'mobile_number' => '+9999' . $mobile_number
        ])->assertStatus(422);

        $this->assertEquals(substr(str_replace('-', '', $mobile_number), -9), User::first()->mobile_number);
    }
}
