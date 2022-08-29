<?php

namespace Tests\Feature;

use App\Domains\Authentication\Models\User;
use App\Domains\ProductManagement\Models\EntityProduct;
use App\Domains\ProductManagement\Models\Favorite;
use Tests\FlowTestCase;

class FavoriteTest extends FlowTestCase
{

    /** @test */
    public function it_should_store_entity_product_as_favorite_for_active()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->setEntityProductFavorite([
            'entity_product_id' => EntityProduct::factory()->create()->id
        ])->assertOk()->assertSee('success');
    }

    /** @test */
    public function it_should_display_all_entity_product_when_added_as_favorite_for_active()
    {
        $user = User::factory()->create();
        Favorite::factory()->ofUser($user)->count(10)->create();
        $this->actingAs($user)->ListUserFavorite()
            ->assertOk()->assertJsonCount(10,'data');
    }
}
