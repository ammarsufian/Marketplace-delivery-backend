<?php

namespace App\Domains\ProductManagement\Actions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Domains\Interfaces\Actionable;
use App\Domains\Authentication\Models\User;
use App\Domains\AccountManagement\Models\Branch;
use App\Domains\ProductManagement\Models\EntityProduct;
use App\Domains\ProductManagement\Http\Requests\StoreEntityProductRequest;

class CreateEntityProductAction implements Actionable
{
    protected Request $request;
    protected User $user;

    function __construct(StoreEntityProductRequest $request)
    {
        $this->request = $request;
        $this->user = Auth::user();
    }

    public function execute(): EntityProduct
    {
        $entityProduct = EntityProduct::create([
            'product_id' => $this->request->get('product_id'),
            'branch_id' => $this->user->branches->first()->id,
            'unit_price' => $this->request->get('unit_price'),
            'discount' => $this->request->get('discount') ?? 0,
        ]);

        $entityProduct->variants()->sync($this->request->variants);

        return $entityProduct;
    }
}
