<?php

namespace Tests\Feature\Authentication;

use App\Domains\Authentication\Models\User;
use Tests\FlowTestCase;

class FirebaseTest extends FlowTestCase
{

    /** @test */
    public function it_should_pass_to_update_fcm_token()
    {
        $user = User::factory()->create();
        $token = $this->faker->text;

        $this->actingAs($user)->updateFirebaseToken($token)
            ->assertOk();
    }
}
