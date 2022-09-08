<?php

namespace Tests\Feature\Authentication;

use App\Domains\Authentication\Models\User;
use Tests\FlowTestCase;

class InvitationFriendTest extends FlowTestCase
{

    public User $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /** @test */
    public function it_should_return_invitation_friends_link()
    {

        $this->actingAs($this->user)->getUserInvitationLink()
            ->assertOk()
            ->assertJsonCount(1, 'data');
        $this->user->refresh()->referral_key;
    }

    /** @test */
    public function it_should_show_link_if_user_has_referral_key()
    {
        $this->get('/user/' . $this->user->referral_key . '/accept-invitation')
            ->assertOk();
    }

    /** @test */
    public function it_cant_show_link_if_user_hasnt_referral_key()
    {
        $this->get('/user/' . '123' . '/accept-invitation')
            ->assertNotFound();
    }
}
