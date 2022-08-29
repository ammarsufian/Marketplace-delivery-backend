<?php

namespace App\Domains\AccountManagement\Services;

use App\Domains\AccountManagement\Actions\IndexBranchAction;
use App\Domains\AccountManagement\Http\Requests\IndexBranchesRequest;
use App\Domains\AccountManagement\Http\Resources\BranchResource;
use Exception;

class BranchService
{
    public function index(IndexBranchesRequest $request)
    {
        try {
            $results = (new IndexBranchAction($request))->execute();

        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false,
            ], 400);
        }

        return BranchResource::collection($results);
    }
}
