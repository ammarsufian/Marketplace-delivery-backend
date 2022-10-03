<?php

namespace App\Domains\AccountManagement\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\AccountManagement\Models\Branch;
use App\Domains\AccountManagement\Services\ProviderBranchService;
use App\Domains\AccountManagement\Http\Requests\StatusBranchRequest;
use App\Domains\AccountManagement\Http\Requests\ScheduleBranchRequest;

class ProviderBranchController extends Controller
{
    public function show(ProviderBranchService $providerBranchService)
    {
        return $providerBranchService->show();
    }
    public function updateScheduleBranch(Branch $branch,ScheduleBranchRequest $request, ProviderBranchService $providerBranchService)
    {
        return $providerBranchService->updateScheduleBranch($request ,$branch);
    }

    public function showActive(ProviderBranchService $providerBranchService)
    {
        return $providerBranchService->showActive();
    }

    public function updateActive(StatusBranchRequest $request,ProviderBranchService $providerBranchService)
    {
        return $providerBranchService->updateActive($request);
    }
}
