<?php

namespace App\Domains\OrderManagement\Actions;

use App\Domains\Interfaces\Actionable;
use App\Domains\OrderManagement\Models\OrderCancelReason;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class GetOrderCancelReasonListAction implements Actionable
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function execute(): Collection
    {
        return OrderCancelReason::all();
    }
}
