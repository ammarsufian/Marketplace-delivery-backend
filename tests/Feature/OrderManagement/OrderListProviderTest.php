<?php

namespace Tests\Feature\OrderManagement;


use App\Domains\Authentication\Models\User;
use App\Domains\OrderManagement\Models\Order;
use App\Domains\AccountManagement\Models\UserBranch;
use App\Domains\AccountManagement\Models\Branch;
use Carbon\Carbon;
use Tests\FlowTestCase;


class OrderListProviderTest extends FlowTestCase
{
    public User $user;
    public UserBranch $userBranch;
    public Branch $branch;


    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create()
            ->assignRole(User::PROVIDER_ROLE);
        $this->branch = Branch::factory()->create();
        $this->user->branches()->sync($this->branch->id);
        Order::factory()->count(25)->ofBranch($this->branch)
            ->ofCreatedAt(Carbon::now())->create(['created_at' => '2022-09-01 08:46:20']);
        Order::factory()->count(50)->ofBranch($this->branch)
            ->ofCreatedAt(Carbon::now())->create();
    }

    /** @test */
    public function get_provider_orders_paginated_with_custom_per_page()
    {
        $this->actingAs($this->user)
            ->getOrderListProvider(50)
            ->assertOk()
            ->assertJsonCount(50, 'data');
    }

    /** @test */
    public function get_provider_orders_paginated_with_custom_date()
    {
        $this->actingAs($this->user)
            ->getOrderListProvider(25, '2022-09-01')
            ->assertOk()
            ->assertJsonCount(25, 'data');
    }
}
