<?php

namespace Tests\Feature\Authentication;

use App\Domains\Authentication\Models\User;
use Tests\FlowTestCase;
use function App\Helpers\mobile;

class LoginTest extends FlowTestCase
{
    /** @test */
    public function it_should_fail_when_send_empty_array()
    {
        $this->login([])->assertStatus(422);
    }

    /** @test */
    public function it_should_fail_when_send_non_exists_mobile_number()
    {
        $this->login([
            'mobile_number' => '123123357'
        ])->assertJsonFragment([
            "mobile_number" => [
                "The mobile number does not exists"
            ]
        ])->assertStatus(422);
    }


    /** @test */
    public function it_should_login_exists_mobile_number_passed_as_client_login()
    {
        $user = User::factory()->create();
        $user->assignRole(User::APPLICATION_ROLE);

        $this->login([
            'mobile_number' => $user->mobile_number
        ])->assertSee('access_token')
            ->assertOk();

        $this->assertEquals(1,User::count());
    }

    /** @test */
    public function it_should_logout_active_mobile_number_passed()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->logout()
            ->assertJsonFragment([
                'success' =>  true
            ])
            ->assertOk();
    }
}
