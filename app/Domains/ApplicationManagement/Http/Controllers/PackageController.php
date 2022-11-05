<?php

namespace App\Domains\ApplicationManagement\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Domains\ApplicationManagement\Services\PackageService;

class PackageController extends Controller
{
    public function __invoke(Request $request,PackageService $packageService)
    {
        return $packageService->index($request);
    }
}
