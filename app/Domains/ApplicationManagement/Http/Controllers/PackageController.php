<?php

namespace App\Domains\ApplicationManagement\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Domains\ApplicationManagement\Services\PackageService;

class PackageController extends Controller
{
    public function index(PackageService $packageService)
    {
        return $packageService->index();
    }

    public function create()
    {
        //
    }

    public function update()
    {
        //
    }

}
