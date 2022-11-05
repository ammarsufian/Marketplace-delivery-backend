<?php

namespace Tests\Feature\OrderManagement;

use App\Domains\AccountManagement\Models\Address;
use App\Domains\OrderManagement\Models\Cart;
use App\Domains\OrderManagement\Models\CartItem;
use App\Domains\OrderManagement\Models\Order;
use App\Domains\Transaction\Models\CreditCard;
use App\Domains\Transaction\Models\PaymentMethod;
use Illuminate\Support\Collection;
use Tests\FlowTestCase;

class OrderTest extends FlowTestCase
{
    public Cart $cart;
    public Address $address;
    public Collection $cartItem;

    protected function setUp(): void
    {
        parent::setUp();
        $this->cart = Cart::factory()->create();
        $this->address = Address::factory()->ofUser($this->cart->user)->create();
        $this->cartItem = CartItem::factory()->ofCart($this->cart)
            ->ofBranch($this->cart->branch)->count(10)->create();

    }

    /** @test */
    public function it_should_create_order()
    {
        $paymentMethod = PaymentMethod::factory()->active()->create();
        $creditCard = CreditCard::factory()->ofUser($this->cart->user)->create();
        $this->actingAs($this->cart->user)->placeOrder([
            'addressId' => $this->address->id,
            'paymentMethodId' => $paymentMethod->id,
            'credit_card_id' => $creditCard->id,
        ])->assertCreated();

        $orders = $this->cart->user->orders;
        $this->assertCount(1, $orders);
        $this->assertCount(10, $orders->first()->items);
        $this->assertEquals($orders->first()->status, Order::PENDING_ORDER_STATUS);
        $this->assertEmpty(Cart::find($this->cart->id));
    }

    /** @test */
    public function it_cannot_create_order_when_payment_method_is_not_active()
    {
        $paymentMethod = PaymentMethod::factory()->notActive()->create();
        $cart = Cart::factory()->ofUser($this->cart->user)->create();
        $this->actingAs($cart->user)->placeOrder([
            'addressId' => $this->address->id,
            'paymentMethodId' => $paymentMethod->id
        ])->assertStatus(400);

        $this->assertNotEmpty(Cart::find($cart->id));
    }

}
