<?php

namespace App\Domains\ProductManagement\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\ProductManagement\Services\VariantService;

class GetEntityProductVariantsController extends Controller
{
    public function __invoke(Request $request, VariantService $variantService)
    {
        return $variantService->getVariantByName($request);
    }
}
