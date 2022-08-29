<?php

namespace App\Domains\ProductManagement\Services;

use Illuminate\Http\Request;
use App\Domains\ProductManagement\Http\Resources\VariantResource;
use App\Domains\ProductManagement\Actions\GetVariantsByNameAction;

class VariantService
{
    public function getVariantByName(Request $request)
    {
        try {
            $results = (new GetVariantsByNameAction($request))->execute();
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false
            ], 400);
        }
        return VariantResource::collection($results);
    }
}