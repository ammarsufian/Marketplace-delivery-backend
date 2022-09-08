<?php

namespace App\Domains\AccountManagement\Services;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Domains\AccountManagement\Models\Branch;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Domains\AccountManagement\Actions\UpdateScheduleBranchAction;
use App\Domains\AccountManagement\Http\Requests\ScheduleBranchRequest;
use App\Domains\AccountManagement\Http\Resources\ProviderBranchResource;

class ProviderBranchService
{
    public function show(): JsonResource
    {
        $branch = Auth::user()->branches->first();
        return ProviderBranchResource::make($branch);
    }

    public function updateScheduleBranch(ScheduleBranchRequest $request, Branch $branch)
    {
        try {
            $results = (new UpdateScheduleBranchAction($request, $branch))->execute();
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false
            ], 400);
        }
        return ProviderBranchResource::make($branch->refresh());
    }

    public function updateStatusBranch(Request $request, Branch $branch)
    {
        $branch->update([
            'status' => $request->get('status')
        ]);
        return ProviderBranchResource::make($branch->refresh());
    }
}
