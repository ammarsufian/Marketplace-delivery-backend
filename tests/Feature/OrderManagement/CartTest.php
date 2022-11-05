<?php

namespace Tests\Feature\OrderManagement;

use App\Domains\AccountManagement\Models\Address;
use App\Domains\ApplicationManagement\Models\Package;
use App\Domains\Authentication\Models\User;
use App\Domains\OrderManagement\Models\Cart;
use App\Domains\OrderManagement\Models\CartItem;
use App\Domains\ProductManagement\Models\EntityProduct;
use App\Domains\ProductManagement\Models\EntityProductVariants;
use Database\Factories\AddressFactory;
use Tests\FlowTestCase;

class CartTest extends FlowTestCase
{
    /** @test */
    public function it_should_failed_to_add_item_when_send_empty_object()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->addItemToCart([])
            ->assertStatus(422);
    }

    /** @test */
    public function it_should_failed_to_add_item_when_buyable_is_incorrect()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->addItemToCart([
            'quantity' => $this->faker->randomDigit(1),
            'buyable_id' => $this->faker->randomDigit(),
            'buyable_type' => $this->faker->text,
            'variants' => [],
        ])->assertStatus(422)
            ->assertSee("Invalid buyable type");
    }

    /** @test */
    public function it_should_failed_to_add_item_when_buyable_id_is_incorrect()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->addItemToCart([
            'quantity' => $this->faker->randomDigit(2),
            'buyable_id' => $this->faker->randomDigit(),
            'buyable_type' => 'EntityProduct',
            'variants' => []
        ])->assertStatus(422);
    }

    /** @test */
    public function it_should_add_entity_product_to_cart()
    {
        $user = User::factory()->has(AddressFactory::new(), 'addresses')->create();
        $entityProduct = EntityProduct::factory()->create();
        $variants = EntityProductVariants::factory()->count(3)->ofEntityProduct($entityProduct)
            ->create();
        $this->actingAs($user)->addItemToCart([
            'variants' => $variants->pluck('variant_id')->toArray(),
            'quantity' => $this->faker->randomDigit(2),
            'buyable_id' => $entityProduct->id,
            'buyable_type' => class_basename($entityProduct),
        ], $user->addresses->first())
            ->assertOk()->assertJsonFragment([
                'message' => 'success'
            ]);

        $this->assertNotEmpty($user->cart);
        $this->assertCount(1, $user->cart->items);
    }

    /** @test */
    public function it_should_add_package_to_cart()
    {
        $user = User::factory()->has(AddressFactory::new(), 'addresses')->create();
        $package = Package::factory()->create();
        $this->actingAs($user)->addItemToCart([
            'variants' => [],
            'quantity' => 1,
            'buyable_id' => $package->id,
            'buyable_type' => class_basename($package),
        ], $user->addresses->first())
            ->assertOk()->assertJsonFragment([
                'message' => 'success'
            ]);

        $this->assertNotEmpty($user->cart);
        $this->assertCount(1, $user->cart->items);
    }

    /** @test */
    public function it_should_delete_item_from_cart_by_id()
    {
        $cart = Cart::factory()->create();
        $cartItem = CartItem::factory()->ofCart($cart)->create();
        $address = Address::factory()->ofUser($cart->user)->create();
        $this->actingAs($cart->user)->deleteCartItemById($cartItem, $address)->assertOk();

        $this->assertEquals(0, $cart->items->count() ?? 0);
    }

    /** @test */
    public function it_cannot_delete_item_from_cart_by_id_when_item_dose_not_exists()
    {
        $cart = Cart::factory()->create();
        $cartItem = CartItem::factory()->create();
        $address = Address::factory()->ofUser($cart->user)->create();
        $this->actingAs($cart->user)->deleteCartItemById($cartItem, $address)->assertStatus(400);

        $this->assertCount(0, $cart->refresh()->items);
    }
}
