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
    public function it_should_update_date_barnch()
    {
        $this->markTestSkipped('not implemented yet');
        $this->actingAs($this->user)
            ->updateTimeBranch(
                $this->branch,
                [
                    'schedule' => $this->getSchedule(),
                    ]
            )->assertOk();
        $this->assertEquals($this->branch->refresh()->schedule, $this->mergeScheduleTime($this->getSchedule()));
    }

    /** @test */
    public function it_cant_update_date_barnch_if_end_greater_than_start()
    {
        $this->markTestSkipped('not implemented yet');
        $this->actingAs($this->user)
            ->updateTimeBranch(
                $this->branch,
                [
                    'schedule' => $this->getSchedule('21:00','09:00'),
                    ]
            )->assertStatus(422);
    }

    /** @test  */
    public function it_cant_update_date_barnch_invlaid_date_format()
    {
        $this->markTestSkipped('not implemented yet');
        $this->actingAs($this->user)
            ->updateTimeBranch(
                $this->branch,
                [
                    'schedule' => $this->getSchedule('21:00','25:00'),
                    ]
            )->assertStatus(422);
    }

    /** @test  */
    public function getSchedule($start='09:00',$end='18:00'): array
    {
        return
            [
                "saturday" => [["start" => $start,"end" => $end]],
                "sunday" => [["start" => $start,"end" => $end]],
                "monday" => [["start" => $start,"end" => $end]],
                "tuesday" => [["start" => $start,"end" => $end]],
                "wednesday" => [["start" => $start,"end" => $end]],
                "thursday" => [["start" => $start,"end" => $end]],
                "friday" => [["start" => $start,"end" => $end]],

            ];
    }

    /** @test  */
    public function it_should_show_branch_status()
    {
        $this->actingAs($this->user)
            ->getBranchStatus($this->branch)
            ->assertOk();
    }

    /** @test  */
    public function it_should_update_status_barnch()
    {
        $this->actingAs($this->user)
            ->updateBranchStatus(
                [
                    'status' => Branch::ACTIVE_STATUS_BRANCH,
                    ]
            )->assertOk();

        $this->assertEquals($this->branch->refresh()->status, Branch::ACTIVE_STATUS_BRANCH);
    }

    /** @test  */
    public function it_can_not_update_status_barnch_valid_status()
    {
        $this->actingAs($this->user)
            ->updateBranchStatus(
                [
                    'status' => 5,
                    ]
            )->assertStatus(422);
    }

    /** @test  */
    public function it_should_show_branch()
    {
        $this->actingAs($this->user)
            ->getProviderBranch()
            ->assertOk();
    }
}
