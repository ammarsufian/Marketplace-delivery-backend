<?php

namespace App\Domains\ProductManagement\Services;

use Illuminate\Http\Request;
use App\Domains\ProductManagement\Actions\GetProductsByNameAction;
use App\Domains\ProductManagement\Http\Resources\ProductResource;

class ProductService
{
    public function getProductByName(Request $request)
    {
        try {
            $results = (new GetProductsByNameAction($request))->execute();
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false
            ], 400);
        }
        return ProductResource::collection($results);
    }
}
