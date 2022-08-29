<?php

namespace Tests\Feature\OrderManagement;

use App\Domains\Authentication\Models\User;
use App\Domains\OrderManagement\Models\Order;
use App\Domains\AccountManagement\Models\UserBranch;
use App\Domains\AccountManagement\Models\Branch;
use App\Domains\OrderManagement\Models\OrderCancelReason;
use Carbon\Carbon;
use Tests\FlowTestCase;

class OrderStatusProviderTest extends FlowTestCase
{
    public User $user;
    public UserBranch $userBranch;
    public Branch $branch;
    public Order $order;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->user->assignRole(User::PROVIDER_ROLE);
        $this->branch = Branch::factory()->create();
        $this->user->branches()->sync($this->branch->id);
    }

    /** @test */
    public function it_cannot_update_order_dose_not_belongs_to_active_user()
    {
        $this->order = Order::factory()->create();
        $this->actingAs($this->user)
            ->updateOrderStatusProvider($this->order, [
                'status' => Order::REJECT_ORDER_STATUS,
                'cancel_reason_id' => OrderCancelReason::first()->id,
            ])->assertStatus(400);
    }

    /** @test */
    public function it_should_be_failed_to_update_order_status_when_status_sent_null()
    {
        $this->order = Order::factory()->create(['branch_id' => $this->branch->id]);
        $this->actingAs($this->user, [
            'status' => null
        ])->updateOrderStatusProvider($this->order)->assertStatus(422);
    }

    /** @test */
    public function it_cannot_update_order_status_into_pending()
    {
        $this->order = Order::factory()->create(['branch_id' => $this->branch->id]);
        $this->actingAs($this->user)
            ->updateOrderStatusProvider($this->order, [
                'status' => Order::PENDING_ORDER_STATUS,
            ])->assertStatus(422);
    }

    /** @test */
    public function it_should_set_order_status_accepted_with_prepration_time()
    {
        $this->order = Order::factory()->create(['branch_id' => $this->branch->id]);
        $this->actingAs($this->user)
            ->updateOrderStatusProvider($this->order, [
                'status' => Order::PREPARING_ORDER_STATUS,
                'preparation_time' => 10,
            ])->assertOk();
    }

    /** @test */
    public function it_should_set_order_rejected_with_cancel_reason_id()
    {
        $this->order = Order::factory()->create(['branch_id' => $this->branch->id]);
        $this->actingAs($this->user)
            ->updateOrderStatusProvider($this->order, [
                'status' => Order::REJECT_ORDER_STATUS,
                'cancel_reason_id' => OrderCancelReason::first()->id,
            ])->assertOk();
    }

    /** @test */
    public function it_cannot_set_order_status_rejected_without_cancel_reason_id()
    {
        $this->order = Order::factory()->create(['branch_id' => $this->branch->id]);
        $this->actingAs($this->user)
            ->updateOrderStatusProvider($this->order, [
                'status' => Order::REJECT_ORDER_STATUS
            ])->assertStatus(422);
    }

}
