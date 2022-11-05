<?php

namespace Tests\Feature\Authentication;

use Tests\FlowTestCase;
use Illuminate\Support\Facades\Hash;
use App\Domains\Authentication\Models\User;


class LoginProviderTest extends FlowTestCase
{
    public User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create()
            ->assignRole(User::PROVIDER_ROLE);
    }

    /** @test */
    public function it_should_fail_when_send_empty_array()
    {
        $this->loginProvider([])->assertStatus(422);
    }

    /** @test */
    public function it_should_fail_when_send_non_exists_mobile_number()
    {
        $this->loginProvider([
            'mobile_number' => '997997979',
            'password' => '123456'
        ])->assertJsonFragment([
            "mobile_number" => [
                "The mobile number does not exists"
            ]
        ])->assertStatus(422);
    }

    /** @test */
    public function iit_should_fail_when_use_invalid_password()
    {
        $this->loginProvider([
            'mobile_number' => $this->user->mobile_number,
            'password' => '123456789'
        ])->assertStatus(400);

    }

    /** @test */
    public function it_should_login_use_mobile_number_and_password_login()
    {
        $this->loginProvider([
            'mobile_number' => $this->user->mobile_number,
            'password' => '123456',
        ])->assertOk();
    }

}
