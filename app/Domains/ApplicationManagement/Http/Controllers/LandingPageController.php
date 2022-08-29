<?php

namespace App\Domains\ApplicationManagement\Http\Controllers;

use App\Domains\ApplicationManagement\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;



class LandingPageController extends Controller
{
    public function __invoke(Request $request,CategoryService $categoryService)
    {
        $categories = $categoryService->index($request);
        return view('landingPage', compact('categories'));
    }
}