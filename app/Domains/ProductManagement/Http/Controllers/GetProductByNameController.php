<?php

namespace App\Domains\ProductManagement\Http\Controllers;

use App\Domains\ProductManagement\Services\ProductService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetProductByNameController extends Controller
{
    public function __invoke(Request $request, ProductService $productService)
    {
        return $productService->getProductByName($request);
    }
}
