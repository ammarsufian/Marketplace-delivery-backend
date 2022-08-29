<?php

namespace Tests\Feature;

use App\Domains\AccountManagement\Models\Branch;
use App\Domains\Authentication\Models\User;
use App\Domains\ProductManagement\Models\EntityProduct;
use App\Domains\ProductManagement\Models\EntityProductVariants;
use App\Domains\ProductManagement\Models\Variant;
use Database\Factories\VariantFactory;
use Illuminate\Support\Collection;
use Tests\FlowTestCase;

class EntityProductTest extends FlowTestCase
{
    public Branch $branch;
    public Collection $entityProducts;
    public User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->branch = Branch::factory()->create();
        $this->entityProducts = EntityProduct::factory()->ofBranch($this->branch)
            ->ofStatus(EntityProduct::ACTIVE_STATUS)
            ->count(10)->create();
    }

    /** @test */
    public function it_should_display_all_entity_products_by_branch_id()
    {
        $this->actingAs($this->user)->listEntityProductsByBranchId($this->branch)
            ->assertOk()
            ->assertJsonCount(10, 'data');
    }

    /** @test */
    public function it_should_filter_entity_product_by_branch_and_category_id()
    {
       $this->actingAs($this->user)->listEntityProductsByBranchId($this->branch, [
            'category_id' => $this->entityProducts->first()->product->category_id
        ])
            ->assertOk()
            ->assertJsonCount(1, 'data');
    }
}
