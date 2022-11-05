<?php

namespace Tests\Feature\ApplicationManagement;

use App\Domains\ApplicationManagement\Models\Package;
use App\Domains\Authentication\Models\User;
use Tests\FlowTestCase;

class PackageTest extends FlowTestCase
{
    /** @test */
    public function it_should_display_active_packages_when_user_has_application_role()
    {
        Package::factory()->count(5)->active()->create();

        $user = User::factory()->create()
            ->assignRole(User::APPLICATION_ROLE);

        $response = $this->actingAs($user)
            ->packagesList()
            ->assertOk();

        $this->assertEquals(5, $response->getOriginalContent()->count());
    }

    /** @test */
    public function it_cannot_display_inactive_packages_when_user_has_application_role()
    {
        Package::factory()->count(5)->inactive()->create();

        $user = User::factory()->create()
            ->assignRole(User::APPLICATION_ROLE);

        $response = $this->actingAs($user)
            ->packagesList()
            ->assertOk();

        $this->assertEquals(0, $response->getOriginalContent()->count());
    }
}
