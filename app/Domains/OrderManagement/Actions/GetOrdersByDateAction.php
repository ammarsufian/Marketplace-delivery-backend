<?php

namespace App\Domains\OrderManagement\Actions;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Domains\Interfaces\Actionable;
use App\Domains\Authentication\Models\User;
use App\Domains\OrderManagement\Models\Order;

class GetOrdersByDateAction implements Actionable
{
    protected Request $request;
    protected User $user;
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->user = Auth::user();
    }

    public function execute(): Collection
    {
        $date = Carbon::parse(($this->request->get('date') ?? Carbon::now()));
        return Order::where('branch_id', $this->user->branches->first()->id)
        ->whereDate('created_at', [$date->startOfDay(), $date->endOfDay()])
        ->orderBy('created_at', 'asc')
        ->get();
    }
}
