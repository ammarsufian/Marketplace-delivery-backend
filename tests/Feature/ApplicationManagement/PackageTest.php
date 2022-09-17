<?php

namespace Tests\Feature\ApplicationManagement;

use App\Domains\ApplicationManagement\Models\Package;
use App\Domains\Authentication\Models\User;
use Tests\FlowTestCase;

class PackageTest extends FlowTestCase
{
    /** @test */
    public function it_should_display_packages_user_as_application()
    {
        Package::factory()->count(5)->create(['is_active' => true]);
        Package::factory()->count(5)->create(['is_active' => false]);
        $user = User::factory()->create();
        $user->assignRole(User::APPLICATION_ROLE);
        $response = $this->actingAs($user)->packagesList()->assertOk();
        $this->assertEquals(5, $response->getOriginalContent()->count());
    }
}
