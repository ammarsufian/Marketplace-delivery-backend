<?php

namespace App\Domains\AccountManagement\Actions;

use Illuminate\Http\Request;
use App\Domains\Interfaces\Actionable;
use App\Domains\AccountManagement\Models\Branch;
use App\Domains\AccountManagement\Http\Requests\StatusBranchRequest;
use Illuminate\Support\Facades\Auth;

class UpdateStatusBranchAction implements Actionable
{
    private Request $request;
    private Branch $branch;

    public function __construct(StatusBranchRequest $request)
    {
        $this->request = $request;
        $this->branch = Auth::user()->branches->first();
    }

    public function execute(): Branch
    {
        $this->branch->update([
            'status' => $this->request->get('status')
        ]);

        return $this->branch->fresh();
    }
}
