<?php

namespace App\Domains\OrderManagement\Actions;

use App\Domains\AccountManagement\Models\Branch;
use App\Domains\Interfaces\Actionable;
use App\Domains\OrderManagement\Models\Cart;
use Illuminate\Support\Facades\Auth;

class GetUserCartAction implements Actionable
{
    protected Branch $branch;

    public function __construct(Branch $branch)
    {
        $this->branch = $branch;
    }

    public function execute(): Cart
    {
        return Auth::user()->cart()->updateOrCreate(['branch_id' => $this->branch->id]);
    }
}
