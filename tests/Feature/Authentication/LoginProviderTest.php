<?php

namespace Tests\Feature\Authentication;

use App\Domains\Authentication\Models\User;
use Tests\FlowTestCase;


class LoginProviderTest extends FlowTestCase
{
    public User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->user->assignRole(User::PROVIDER_ROLE);
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
            'mobile_number' => '997997979'
        ])->assertJsonFragment([
            "mobile_number" => [
                "The mobile number does not exists"
            ]
        ])->assertStatus(422);
    }

    /** @test */
    public function it_should_login_use_mobile_number_login() {
            $this->loginProvider(
                ['mobile_number' => $this->user->mobile_number,]
            )->assertOk();
        
    }

}
