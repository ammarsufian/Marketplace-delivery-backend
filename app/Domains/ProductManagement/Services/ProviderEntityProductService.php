<?php

namespace App\Domains\ProductManagement\Services;

use App\Domains\ProductManagement\Actions\CreateEntityProductAction;
use App\Domains\ProductManagement\Actions\UpdateEntityProductAction;
use App\Domains\ProductManagement\Http\Requests\EditEntityProductRequest;
use App\Domains\ProductManagement\Http\Requests\StoreEntityProductRequest;
use App\Domains\ProductManagement\Http\Resources\EntityProductResource;
use App\Domains\ProductManagement\Models\EntityProduct;

class ProviderEntityProductService
{
    public function create(StoreEntityProductRequest $request)
    {
        try {
            $results = (new CreateEntityProductAction($request))->execute();
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false
            ], 400);
        }
        return response()->json([
            'message' => 'Create entity product success',
            'success' => true,
            'data' => EntityProductResource::make($results)
        ], 200);
    }

    public function update(EditEntityProductRequest $request, EntityProduct $entityProduct)
    {
        try {
            $results = (new UpdateEntityProductAction($request, $entityProduct))->execute();

        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false
            ], 400);
        }
        return response()->json([
            'message' => 'Update entity product successfully',
            'success' => true,
            'data' => $results,
        ], 200);
    }
}
