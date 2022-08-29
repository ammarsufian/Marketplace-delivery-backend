<?php

namespace Tests\Feature\OrderManagement;


use App\Domains\Authentication\Models\User;
use App\Domains\OrderManagement\Models\Order;
use App\Domains\AccountManagement\Models\UserBranch;
use App\Domains\AccountManagement\Models\Branch;
use Tests\FlowTestCase;


class OrderListProviderTest extends FlowTestCase
{
    public User $user;
    public UserBranch $userBranch;
    public Branch $branch;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->user->assignRole(User::PROVIDER_ROLE);
        $this->branch = Branch::factory()->create();
        $this->user->branches()->sync($this->branch->id);

        Order::factory()->count(50)->create([
            'user_id' => User::factory()->create()->id,
            'branch_id' => $this->branch->id,
        ]);

    }

    /** @test */
    public function get_provider_orders_paginated_with_custom_per_page()
    {
        $this->actingAs($this->user)
            ->getOrderListProvider(50)
            ->assertOk()
            ->assertJsonCount(50, 'data');
    }
}
