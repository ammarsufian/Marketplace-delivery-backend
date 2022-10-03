<?php

namespace App\Domains\AccountManagement\Actions;

use Illuminate\Http\Request;
use App\Domains\Interfaces\Actionable;
use App\Domains\AccountManagement\Models\Branch;
use App\Domains\AccountManagement\Http\Requests\StatusBranchRequest;

class UpdateStatusBranchAction implements Actionable
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var Branch
     */
    private $branch;

    /**
     * UpdateStatusBranchAction constructor.
     * @param Request $request
     * @param Branch $branch
     */
    public function __construct(StatusBranchRequest $request, Branch $branch)
    {
        $this->request = $request;
        $this->branch = $branch;
    }

    /**
     * @return bool
     */
    public function execute(): bool
    {
        return $this->branch->update([
            'status' => $this->request->status
        ]);

    }
}
