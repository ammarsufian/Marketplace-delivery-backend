<?php

namespace Tests\Feature\ApplicationManagement;

use App\Domains\ApplicationManagement\Models\Category;
use App\Domains\Authentication\Models\User;
use Tests\FlowTestCase;

class CategoryTest extends FlowTestCase
{

    /** @test */
    public function it_should_display_categories_on_home_page()
    {
        Category::factory()->withShownOnHomePage()->count(5)->create();

        $user = User::factory()->create();

        $response = $this->actingAs($user)->categoriesList(5)->assertOk();

        $this->assertEquals(5, collect($response->getOriginalContent())->count());
    }
}
