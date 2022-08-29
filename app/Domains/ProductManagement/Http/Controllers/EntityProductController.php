<?php

namespace App\Domains\ProductManagement\Http\Controllers;

use App\Domains\AccountManagement\Models\Branch;
use App\Domains\ProductManagement\Services\EntityProductService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EntityProductController extends Controller
{
    public function __invoke(Branch $branch, Request $request, EntityProductService $entityProductService)
    {
        return $entityProductService->index($branch, $request);
    }
}
