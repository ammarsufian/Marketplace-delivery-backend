<?php

namespace Tests\Feature;

use Tests\FlowTestCase;
use App\Domains\Authentication\Models\User;
use App\Domains\AccountManagement\Models\Branch;
use App\Domains\AccountManagement\Traits\MergeScheduleTimeTrait;

class ProviderBranchTest extends FlowTestCase
{
    use MergeScheduleTimeTrait;

    public User $user;
    public Branch $branch;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create()
            ->assignRole(User::PROVIDER_ROLE);
        $this->branch = Branch::factory()->create();
        $this->user->branches()->sync($this->branch->id);
    }

    /** @test */
    public function it_should_update_status_branch()
    {
        $this->actingAs($this->user)
            ->updateBranchStatus(
                [
                    'status' => Branch::ACTIVE_STATUS_BRANCH,
                ]
            )->assertOk();

        $this->assertEquals($this->branch->refresh()->status, Branch::ACTIVE_STATUS_BRANCH);
    }

    /** @test */
    public function it_can_not_update_status_branch_valid_status()
    {
        $this->actingAs($this->user)
            ->updateBranchStatus(
                [
                    'status' => 5,
                ]
            )->assertStatus(422);
    }

    /** @test */
    public function it_should_show_branch()
    {
        $this->actingAs($this->user)
            ->getProviderBranch()
            ->assertOk();
    }
}
