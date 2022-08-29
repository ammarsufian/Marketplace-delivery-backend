<?php

namespace Tests\Feature\Authentication;

use App\Domains\Authentication\Models\User;
use Tests\FlowTestCase;
use function App\Helpers\mobile;

class ProfileTest extends FlowTestCase
{
    public User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /** @test */
    public function it_cannot_edit_profile_with_exists_mobile_number()
    {
        $user = User::factory()->create();

        $this->actingAs($this->user)->updateProfile([
            'mobile_number' => $user->mobile_number
        ])->assertStatus(422);
    }

    /** @test */
    public function it_should_edit_user_profile()
    {
        $this->actingAs($this->user)->updateProfile([
            'email' => $email = $this->faker->email,
            'name' => $name = $this->faker->name,
            'mobile_number' => $mobile_number = mobile($this->faker->phoneNumber)
        ])->assertStatus(200);

        $user = $this->user->refresh();

        $this->assertEquals($user->email,$email);
        $this->assertEquals($user->mobile_number,$mobile_number);
        $this->assertEquals($user->name,$name);
    }

    /** @test */
    public function it_should_edit_user_profile_his_old_mobile_number()
    {
        $this->actingAs($this->user)->updateProfile([
            'mobile_number' => mobile($this->user->mobile_number)
        ])->assertStatus(200);
    }

    /** @test */
    public function it_should_edit_user_profile_details_except_the_mobile()
    {
        $this->actingAs($this->user)->updateProfile([
            'name' => $name = $this->faker->name,
            'mobile_number' => mobile($this->user->mobile_number)
        ])->assertStatus(200);

        $this->assertEquals($this->user->refresh()->name,$name);
    }
}
