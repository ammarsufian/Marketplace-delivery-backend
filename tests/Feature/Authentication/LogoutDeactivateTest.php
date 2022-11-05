<?php

namespace Tests\Feature\Authentication;

use App\Domains\Authentication\Models\User;
use Tests\FlowTestCase;


class LogoutDeactivateTest extends FlowTestCase
{
    public User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create()
            ->assignRole(User::PROVIDER_ROLE);
    }

    /** @test */
    public function it_should_fail_when_unauthenticated()
    {
        $this->logoutProvider()->assertStatus(401);
    }

    /** @test */
    public function it_should_logout_a_provider()
    {
        $this->actingAs($this->user)
            ->logoutProvider()
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
    }

    /** @test */
    public function it_should_fail_when_deactivating_unauthenticated()
    {
        $this->deactivateProvider()->assertStatus(401);
    }

    /** @test */
    public function it_should_deactivate_a_provider()
    {
        $this->actingAs($this->user)
            ->deactivateProvider()
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'User deactivated successfully'
            ]);
    }


}

// $this->actingAs($this->user)
