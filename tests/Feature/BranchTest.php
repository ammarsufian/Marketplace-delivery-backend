<?php

namespace Tests\Feature;

use App\Domains\AccountManagement\Models\Address;
use App\Domains\AccountManagement\Models\Branch;
use App\Domains\ApplicationManagement\Models\Category;
use App\Domains\Authentication\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Tests\FlowTestCase;

class BranchTest extends FlowTestCase
{
    protected Collection $branches;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->branches = Branch::factory()->count(10)->create();
        $this->user = User::factory()->create();
        $this->address = Address::factory()->ofLocation($this->branches->first()->latitude,$this->branches->first()->longitude)->ofUser($this->user)->create();
    }

    /** @test */
    public function it_should_display_nearer_branches()
    {
        $branch = $this->branches->first();

        $this->actingAs($this->user)->GetNearerLocations([
            'addressId' => $this->address->id,
            'type' => $branch->type
        ])->assertOk()->assertJsonCount(1, 'data');
    }

    /** @test */
    public function it_should_set_branch_closed_when_current_time_is_out_of_branch_schedule()
    {
        $branch = $this->branches->last();
        Carbon::setTestNow(Carbon::create(2021, 5, 25, 1));

        $response = $this->actingAs($this->user)->GetNearerLocations([
            'addressId' => $this->address->id,
            'type' => $branch->type
        ])->assertOk()
            ->assertJsonCount(1, 'data');

        $data = collect(json_decode($response->getContent())->data)->first();
        $this->assertTrue($data->is_closed);
    }

    /** @test */
    public function it_should_set_branch_opened_when_current_time_is_inside_of_branch_schedule()
    {
        $branch = $this->branches->first();
        Carbon::setTestNow(Carbon::create(2021, 5, 25, 11));

        $response = $this->actingAs($this->user)->GetNearerLocations([
            'addressId' => $this->address->id,
            'type' => $branch->type
        ])->assertOk()
            ->assertJsonCount(1, 'data');

        $data = collect(json_decode($response->getContent())->data)->first();

        $this->assertFalse($data->is_closed);
    }

    /** @test */
    public function it_should_filter_branches_by_category_id_and_return_null_if_dose_not_exists()
    {
        $branch = $this->branches->first();

        $this->actingAs($this->user)->GetNearerLocations([
            'addressId' => $this->address->id,
            'type' => $branch->type,
            'category_id' => Category::factory()->create()->id,
        ])->assertOk()
            ->assertJsonCount(0, 'data');
    }

    /** @test */
    public function it_should_filter_branches_by_category_id()
    {
        $branch = $this->branches->first();
        $category = Category::factory()->create();
        $branch->categories()->attach($category);

        $this->actingAs($this->user)->GetNearerLocations([
            'addressId' => $this->address->id,
            'type' => $branch->type,
            'category_id' => "$category->id",
        ])->assertOk()
            ->assertJsonCount(1, 'data');
    }
}
