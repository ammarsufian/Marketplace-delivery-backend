<?php

namespace App\Domains\ProductManagement\Actions;

use Illuminate\Http\Request;
use App\Domains\Interfaces\Actionable;
use App\Domains\ProductManagement\Models\EntityProduct;
use App\Domains\ProductManagement\Http\Requests\EditEntityProductRequest;

class UpdateEntityProductAction implements Actionable
{
    protected Request $request;
    protected EntityProduct $entityProduct;

    function __construct(EditEntityProductRequest $request, EntityProduct $entityProduct)
    {
        $this->request = $request;
        $this->entityProduct = $entityProduct;
    }

    public function execute(): bool
    {
        $results = $this->entityProduct->update([
            'unit_price' => $this->request->get('unit_price'),
            'discount' => $this->request->get('discount'),
        ]);

        $this->entityProduct->variants()->sync($this->request->variants);

        return $results;

    }
}
