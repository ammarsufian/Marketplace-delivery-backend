<?php

namespace Tests\Feature;

use App\Domains\ProductManagement\Models\EntityProduct;
use Tests\FlowTestCase;
use App\Domains\Authentication\Models\User;
use App\Domains\AccountManagement\Models\Branch;
use App\Domains\ProductManagement\Models\Product;
use App\Domains\ProductManagement\Models\Variant;

class ProviderEntityProductTest extends FlowTestCase
{
    public User $user;
    public Branch $branch;
    public Product $product;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create()
            ->assignRole(User::PROVIDER_ROLE);

        $this->branch = Branch::factory()->create();
        $this->user->branches()->sync($this->branch->id);
        $this->product = Product::factory()->create();
    }

    /** @test */
    public function it_should_create_entity_product()
    {
        $this->actingAs($this->user)
            ->createEntityProduct($this->getEntityProductData())
            ->assertOk();

        $this->assertEquals(1, EntityProduct::count());
        $this->assertCount(3, EntityProduct::first()->variants);
    }

    /** @test */
    public function it_cannot_create_entity_product_when_unit_price_less_than_one()
    {
        $this->actingAs($this->user)
            ->createEntityProduct(
                $this->getEntityProductData([
                    'unit_price' => -1
                ])
            )->assertStatus(422);
    }

    /** @test */
    public function it_cannot_create_entity_product_when_variants_price_less_than_one()
    {
        $this->actingAs($this->user)
            ->createEntityProduct(
                $this->getEntityProductData([
                    'variant_price' => -1
                ]))
            ->assertStatus(422);
    }

    /** @test */
    public function it_cannot_create_entity_product_when_product_is_not_selected()
    {
        $this->actingAs($this->user)
            ->createEntityProduct(
                $this->getEntityProductData([
                    'product_id' => null,
                ])
            )->assertStatus(422);
    }

    /** @test */
    public function it_should_update_entity_product()
    {
        $entityProduct = EntityProduct::factory()->ofProduct($this->product)->create();
        $productData = $this->getEntityProductData(['unit_price' => 3]);
        $this->actingAs($this->user)
            ->updateEntityProduct($entityProduct, $productData)
            ->assertOk();

        $this->assertEquals($this->product->id, $entityProduct->fresh()->product_id);
    }

    protected function getEntityProductData(array $attributes = []): array
    {
        return [
            'product_id' => data_get($attributes, 'product_id', $this->product->id),
            'variants' => $this->getVariants($attributes),
            'unit_price' => data_get($attributes, 'unit_price', $this->faker->randomNumber(2)),
            'discount' => $this->faker->randomDigit(),
        ];
    }

    protected function getVariants(array $attributes): array
    {
        return Variant::factory()->count(data_get($attributes, 'variant_count', 3))->create()
            ->map(function (Variant $variant) use ($attributes) {
                return [
                    'variant_id' => $variant->id,
                    'price' => data_get($attributes, 'variant_price', $this->faker->randomNumber(2))
                ];
            })->toArray();
    }
}
