<?php

namespace App\Domains\ProductManagement\Services;

use Illuminate\Http\Request;
use App\Domains\AccountManagement\Models\Branch;
use App\Domains\ProductManagement\Actions\GetBranchEntityProductAction;
use App\Domains\ProductManagement\Http\Resources\EntityProductResource;

class EntityProductService
{
    public function index(Branch $branch, Request $request)
    {
        try {
            $results = (new GetBranchEntityProductAction($branch, $request))->execute();
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false
            ], 400);
        }
        return EntityProductResource::collection($results);
    }
}
