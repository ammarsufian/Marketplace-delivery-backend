<?php

namespace App\Domains\AccountManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Domains\AccountManagement\Services\ProviderBranchService;
use App\Domains\AccountManagement\Http\Requests\ScheduleBranchRequest;
use App\Domains\AccountManagement\Models\Branch;

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
}
