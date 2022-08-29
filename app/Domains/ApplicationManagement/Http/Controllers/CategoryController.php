<?php

namespace App\Domains\ApplicationManagement\Http\Controllers;

use App\Domains\ApplicationManagement\Services\CategoryService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request, CategoryService $categoryService)
    {
        return $categoryService->index($request);
    }
}
