<?php

namespace Tests\Feature;

use App\Domains\Transaction\Models\CreditCard;
use App\Domains\Transaction\Models\CreditCardCompany;
use App\Domains\Authentication\Models\User;
use Carbon\Carbon;
use Tests\FlowTestCase;

class CreditCardTest extends FlowTestCase
{
    /** @test */
    public function it_should_create_user_credit_card()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->createCreditCard([
            'name' => $this->faker->name,
            'card_number' => $this->faker->creditCardNumber,
            'expiration_date' =>  "09/23",
            'cvv' => $this->faker->randomDigit(3),
        ])->assertOk();

        $this->assertCount(1, $user->creditCards);
    }

    /** @test */
    public function it_should_create_user_credit_card_with_visa_company()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->createCreditCard([
            'name' => $this->faker->name,
            'card_number' => $this->faker->creditCardNumber('Visa'),
            'expiration_date' =>  "09/23",
            'cvv' => $this->faker->randomDigit(3),
        ])->assertOk();

        $this->assertCount(1, $user->creditCards);
        $this->assertEquals('visa',$user->creditCards->first()->company->slug);
    }

    /** @test */
    public function it_should_create_user_credit_card_with_master_company()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->createCreditCard([
            'name' => $this->faker->name,
            'card_number' => $this->faker->creditCardNumber('MasterCard'),
            'expiration_date' =>  "09/23",
            'cvv' => $this->faker->randomDigit(3),
        ])->assertOk();

        $this->assertCount(1, $user->creditCards);
        $this->assertEquals('master-card',$user->creditCards->first()->company->slug);
    }

    /** @test */
    public function it_cannot_create_user_credit_card_with_old_expiration_date()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->createCreditCard([
            'name' => $this->faker->name,
            'card_number' => $this->faker->creditCardNumber('MasterCard'),
            'expiration_date' =>  "09/10",
            'cvv' => $this->faker->randomDigit(3),
        ])->assertStatus(400);

        $this->assertCount(0, $user->creditCards);
    }

    /** @test */
    public function it_cannot_create_user_credit_card_with_invalid_date()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->createCreditCard([
            'name' => $this->faker->name,
            'card_number' => $this->faker->creditCardNumber('MasterCard'),
            'expiration_date' =>  "19/10",
            'cvv' => $this->faker->randomDigit(3),
        ])->assertStatus(422);

        $this->assertCount(0, $user->creditCards);
    }

    /** @test */
    public function it_cannot_create_user_credit_card_with_exists_card_number()
    {
        $user = User::factory()->create();
        $creditCard = CreditCard::factory()->ofUser($user)->create();

        $this->actingAs($user)->createCreditCard([
            'name' => $this->faker->name,
            'card_number' => $creditCard->card_number,
            'expiration_date' =>  "09/10",
            'cvv' => $this->faker->randomDigit(3),
        ])->assertStatus(422);

        $this->assertCount(1, $user->creditCards);
    }

    /** @test */
    public function it_cannot_update_credit_card_related_for_another_user()
    {
        $user = User::factory()->create();
        $creditCard = CreditCard::factory()->create();

        $this->actingAs($user)->updateCreditCard($creditCard,[
            'name' => $this->faker->name,
            'card_number' => $creditCard->card_number,
            'expiration_date' =>  "09/10",
            'cvv' => $this->faker->randomDigit(3),
        ])->assertStatus(400);

    }
    /** @test */
    public function it_should_update_credit_card_exists()
    {
        $user = User::factory()->create();
        $creditCard = CreditCard::factory()->ofUser($user)->create();

        $this->actingAs($user)->updateCreditCard($creditCard,[
            'name' => $this->faker->name,
            'card_number' => $cardNumber = $this->faker->creditCardNumber('Visa'),
            'expiration_date' =>  $expiryDate = "09/10",
            'cvv' => $cvv = $this->faker->randomDigit(3),
        ])->assertStatus(200);

        $creditCard = $creditCard->fresh();
        $this->assertEquals($creditCard->card_number,$cardNumber);
        $this->assertEquals(Carbon::parse($creditCard->expiration_date)->format('m/y'),$expiryDate);
        $this->assertEquals($creditCard->cvv,$cvv);
    }

    /** @test */
    public function it_should_delete_credit_card_exists()
    {
        $user = User::factory()->create();
        $creditCard = CreditCard::factory()->ofUser($user)->create();
        $this->actingAs($user)->deleteCreditCard($creditCard)->assertOk();
        $this->assertCount(0, $user->creditCards);
    }

    /** @test */
    public function it_should_delete_credit_card_exists_in_list_credit_cards()
    {
        $user = User::factory()->create();
        $creditCard = CreditCard::factory()->ofUser($user)->count(5)->create();
        $this->actingAs($user)->deleteCreditCard($creditCard->first())->assertOk();
        $this->assertCount(4, $user->creditCards);
    }

    /** @test */
    public function it_should_not_delete_credit_card_related_for_another_user()
    {
        $user = User::factory()->create();
        $creditCard = CreditCard::factory()->count(10)->create();
        $this->actingAs($user)->deleteCreditCard($creditCard->first())->assertStatus(400);
        $this->assertCount(0, $user->creditCards);
    }

    /** @test */
    public function it_cannot_to_delete_user_credit_card_when_user_id_invalid()
    {
        $user = User::factory()->count(2)->create();
        $creditCard = CreditCard::factory()->ofUser($user[0])->create();
        $this->actingAs($user[1])->deleteCreditCard($creditCard)->assertStatus(400);
        $this->assertCount(1, $user[0]->creditCards);
    }

    /** @test */
    public function it_should_display_user_credit_cards()
    {
        $user = User::factory()->create();
        $creditCard = CreditCard::factory()->ofUser($user)->count(5)->create();
        $this->actingAs($user)->listCreditCard()->assertOk();
        $this->assertCount(5, $user->creditCards);
    }

}
