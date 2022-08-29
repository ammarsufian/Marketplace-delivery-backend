<?php

namespace Tests\Feature\OrderManagement;

use App\Domains\AccountManagement\Models\Address;
use App\Domains\OrderManagement\Actions\PromoCode\CashBackAction;
use App\Domains\OrderManagement\Actions\PromoCode\DeliveryPercentageDiscountAction;
use App\Domains\OrderManagement\Actions\PromoCode\DeliveryPriceDiscountAction;
use App\Domains\OrderManagement\Models\Cart;
use App\Domains\OrderManagement\Models\CartItem;
use App\Domains\OrderManagement\Models\PromoCode;
use App\Domains\ProductManagement\Models\EntityProduct;
use App\Domains\Transaction\Models\UserTransaction;
use Carbon\Carbon;
use Tests\FlowTestCase;

class PromoCodeTest extends FlowTestCase
{
    public Cart $cart;
    public Address $address;

    protected function setUp(): void
    {
        parent::setUp();

        $this->entityProduct = EntityProduct::factory()->create();
        $this->cart = Cart::factory()->ofBranch($this->entityProduct->branch)->create();
        $this->address = Address::factory()->ofUser($this->cart->user)->create();
        CartItem::factory()->ofCart($this->cart)->create();
    }

    /** @test */
    public function it_should_failed_when_promo_is_expired()
    {
        $promoCode = PromoCode::factory()->durationBetween(
            Carbon::now()->subDays(3),
            Carbon::now()->subDay()
        )->create();

        $this->actingAs($this->cart->user)->checkPromoCode([
            'promo_code'=>$promoCode->promo_code,
            'addressId'=>$this->address->id
        ])->assertStatus(400);
    }

    /** @test */
    public function it_should_failed_when_promo_is_not_started_yet()
    {
        $cart = Cart::factory()->create();
        CartItem::factory()->ofCart($cart)->create();

        $promoCode = PromoCode::factory()->durationBetween(
            Carbon::now()->addDay(),
            Carbon::now()->addDays(4)
        )->create();

        $this->actingAs($cart->user)->checkPromoCode([
            'promo_code'=>$promoCode->promo_code,
            'addressId'=>$this->address->id
        ])->assertStatus(400);
    }

    /** @test */
    public function it_should_failed_when_promo_is_not_exists()
    {
        CartItem::factory()->ofCart($this->cart)->create();

        $this->actingAs($this->cart->user)->checkPromoCode(['promo_code'=>'hello world'])
            ->assertStatus(422);
    }
    /** @test */
    public function it_should_failed_when_promo_code_counter_is_zero()
    {
        CartItem::factory()->ofCart($this->cart)->create();
        $promoCode = PromoCode::factory()->durationBetween(
            Carbon::now()->subDay(),
            Carbon::now()->addDay()
        )->ofCounter(0)->create();

        $this->actingAs($this->cart->user)->checkPromoCode(['promo_code'=>$promoCode->promo_code])
            ->assertStatus(400);
    }

    /** @test */
    public function it_should_calculate_new_delivery_price_when_promo_type_is_discount_on_delivery_price()
    {
        $promoCode = PromoCode::factory()->ofType(DeliveryPriceDiscountAction::class)
            ->durationBetween(
            Carbon::now()->subDay(),
            Carbon::now()->addDay()
        )->create();

        $this->actingAs($this->cart->user)->checkPromoCode([
            'promo_code'=>$promoCode->promo_code,
            'addressId'=>$this->address->id
        ])->assertStatus(200);
    }

    /** @test */
    public function it_should_calculate_new_delivery_price_when_promo_type_is_discount_on_delivery_percentage()
    {
        $promoCode = PromoCode::factory()->ofType(DeliveryPercentageDiscountAction::class)
            ->durationBetween(
                Carbon::now()->subDay(),
                Carbon::now()->addDay()
            )->ofCounter(1)->create();

       $this->actingAs($this->cart->user)->checkPromoCode(['promo_code'=>$promoCode->promo_code,'addressId'=>$this->address->id])
            ->assertStatus(200);
    }

    /** @test */
    public function it_should_calculate_new_delivery_price_when_promo_type_is_cash_back()
    {
        $promoCode = PromoCode::factory()->ofType(CashBackAction::class)
            ->durationBetween(
                Carbon::now()->subDay(),
                Carbon::now()->addDay()
            )->ofCounter(3)->create();

        $this->actingAs($this->cart->user)->checkPromoCode(['promo_code'=>$promoCode->promo_code,'addressId' => $this->address->id])
            ->assertStatus(200);

        $this->assertEquals(1,UserTransaction::query()->ofUser($this->cart->user_id)->count());
    }
}
