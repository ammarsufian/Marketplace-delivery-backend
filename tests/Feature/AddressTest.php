<?php

namespace Tests\Feature;

use App\Domains\AccountManagement\Models\Address;
use App\Domains\ApplicationManagement\Models\City;
use App\Domains\Authentication\Models\User;
use Tests\FlowTestCase;

class AddressTest extends FlowTestCase
{
    /** @test */
    public function it_should_create_user_address_with_exists_city_name()
    {
        $user = User::factory()->create();
        $city = City::factory()->create();

        $this->actingAs($user)->createUserAddress([
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'is_default' => $this->faker->boolean,
            'type' => $this->faker->text,
            'user_id' => $user->id,
            'city_name' => $city->name,
            'details' => $this->faker->address
        ])->assertOk();

        $this->assertCount(1, $user->addresses);
    }

    /** @test */
    public function it_should_create_user_address()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->createUserAddress([
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'is_default' => $this->faker->boolean,
            'type' => $this->faker->text,
            'user_id' => $user->id,
            'city_name' => $this->faker->city,
            'details' => $this->faker->address
        ])->assertOk();

        $this->assertCount(1, $user->addresses);
    }

    /** @test */
    public function it_should_display_user_address()
    {
        $user = User::factory()->create();

        Address::factory()->ofUser($user)->count(10)->create();

        $this->actingAs($user)->getUserAddress()
            ->assertOk()->assertJsonCount(10, 'data');

        $this->assertCount(10, $user->addresses);
    }

    /** @test */
    public function it_should_pass_to_update_user_address()
    {
        $user = User::factory()->create();

        $address = Address::factory()->ofUser($user)->create();

        $this->actingAs($user)->updateUserAddress($address, [
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'is_default' => $this->faker->boolean,
            'city_name' => $this->faker->name
        ])->assertOk()
            ->assertJsonCount(1, 'data');

        $this->assertCount(1, $user->addresses);
    }

    /** @test */
    public function it_cannot_to_update_user_address_when_user_id_invalid()
    {
        $user = User::factory()->create();

        $address = Address::factory()->create();

        $this->actingAs($user)->updateUserAddress($address, [
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'is_default' => $this->faker->boolean,
            'city_name' => $this->faker->name
        ])->assertStatus(400);
    }

    /** @test */
    public function it_should_pass_to_delete_user_address()
    {
        $user = User::factory()->create();

        $address = Address::factory()->ofUser($user)->create();

        $this->actingAs($user)->deleteUserAddress($address)->assertOk();

        $this->assertCount(0, $user->addresses);
    }

    /** @test */
    public function it_cannot_to_delete_user_address_when_user_id_invalid()
    {
        $user = User::factory()->create();

        $address = Address::factory()->create();

        $this->actingAs($user)->deleteUserAddress($address)->assertStatus(400);

        $this->assertCount(0, $user->addresses);
    }
}
