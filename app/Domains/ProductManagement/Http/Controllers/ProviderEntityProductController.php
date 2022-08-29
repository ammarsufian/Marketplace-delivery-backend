<?php

namespace App\Domains\ProductManagement\Http\Controllers;

use App\Domains\ProductManagement\Http\Requests\EditEntityProductRequest;
use App\Domains\ProductManagement\Http\Requests\StoreEntityProductRequest;
use App\Domains\ProductManagement\Models\EntityProduct;
use App\Domains\ProductManagement\Services\ProviderEntityProductService;
use App\Http\Controllers\Controller;

class ProviderEntityProductController extends Controller
{
    public function store(StoreEntityProductRequest $request, ProviderEntityProductService $providerEntityProductService)
    {
        return $providerEntityProductService->create($request);
    }

    public function update(EntityProduct $entityProduct, EditEntityProductRequest $request, ProviderEntityProductService $providerEntityProductService)
    {
        return $providerEntityProductService->update($request, $entityProduct);
    }
}
