<?php

namespace Tests\Feature\Authentication;

use App\Domains\Authentication\Models\User;
use Tests\FlowTestCase;

class InvitationFriendTest extends FlowTestCase
{

    /** @test */
    public function it_should_return_invitation_friends_link()
    {
        $user = User::factory()->create();
        dd($this->actingAs($user)->getUserInvitationLink());
    }
}
