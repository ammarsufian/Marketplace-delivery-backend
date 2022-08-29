<?php

namespace App\Domains\AccountManagement\Http\Controllers;

use App\Domains\AccountManagement\Http\Requests\IndexBranchesRequest;
use App\Domains\AccountManagement\Services\BranchService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BranchesController extends Controller
{
    public function __invoke(IndexBranchesRequest $request, BranchService $branchService)
    {
        return $branchService->index($request);
    }

}
