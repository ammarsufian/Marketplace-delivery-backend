<?php

namespace App\Domains\AccountManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Domains\AccountManagement\Services\ProviderBranchService;
use App\Domains\AccountManagement\Http\Requests\ScheduleBranchRequest;
use App\Domains\AccountManagement\Models\Branch;
use Illuminate\Http\Request;

class ProviderBranchController extends Controller
{
    public function show(ProviderBranchService $providerBranchService)
    {
        return $providerBranchService->show();
    }

    public function updateScheduleBranch(Branch $branch, ScheduleBranchRequest $request, ProviderBranchService $providerBranchService)
    {
        return $providerBranchService->updateScheduleBranch($request, $branch);
    }

    public function updateStatusBranch(Branch $branch, Request $request, ProviderBranchService $providerBranchService)
    {
        return $providerBranchService->updateStatusBranch($request, $branch);
    }
}
