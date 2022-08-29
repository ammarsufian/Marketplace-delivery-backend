<?php

namespace App\Domains\AccountManagement\Actions;

use Illuminate\Http\Request;
use App\Domains\Interfaces\Actionable;
use App\Domains\AccountManagement\Models\Branch;
use App\Domains\AccountManagement\Http\Requests\ScheduleBranchRequest;


class UpdateScheduleBranchAction implements Actionable
{
    protected Request $request;
    protected Branch $branch;

    public function __construct(ScheduleBranchRequest $request, Branch $branch)
    {
        $this->request = $request;
        $this->branch = $branch;
    }

    public function execute(): bool
    {
        return $this->branch->update([
            'schedule' => $this->request->get('schedule')
        ]);
    }
}
