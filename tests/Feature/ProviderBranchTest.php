<?php

namespace Tests\Feature;

use PHPUnit\Framework\Test;
use Tests\FlowTestCase;
use App\Domains\Authentication\Models\User;
use App\Domains\AccountManagement\Models\Branch;


class ProviderBranchTest extends FlowTestCase
{
    public User $user;
    public Branch $branch;

    public function setUp(): void
    {
        parent::setUp();
        $this->markTestSkipped('should be resolved by Hasant.');
        $this->user = User::factory()->create()
            ->assignRole(User::PROVIDER_ROLE);
        $this->branch = Branch::factory()->create();
        $this->user->branches()->sync($this->branch->id);
    }


    /** @test */
    public function it_should_update_date_barnch()
    {
        $this->actingAs($this->user)
            ->updateTimeBranch(
                $this->branch,
                ['schedule' => $this->getSchedule()]
            )
            ->assertOk();
    }
    public function getSchedule(): array
    {

        return
            [
                "saturday" => ["9:00"],
//                "sunday" => ["4:00-23:00"],
//                "monday" => ["5:00-28:00"],
//                "thursday" => ["9:00-23:00"],
//                "wednesday" => ["9:00-23:00"],
//                "tuesday" => ["1:00-23:00"],
//                "friday" => ["19:00-23:00"]
            ];
    }
}
