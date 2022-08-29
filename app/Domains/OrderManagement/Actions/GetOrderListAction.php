<?php

namespace App\Domains\OrderManagement\Actions;

use App\Domains\Authentication\Models\User;
use App\Domains\Interfaces\Actionable;
use App\Domains\OrderManagement\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetOrderListAction implements Actionable
{
    protected Request $request;
    protected User $user;
    protected Carbon $date;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->user = Auth::user();
        $this->date = Carbon::parse($this->request->get('date'));
    }

    public function execute()
    {
        return Order::query()
            ->whereBetween('created_at', [$this->date->startOfDay(), $this->date->endOfDay()])
            ->when($this->user->hasRole('application'), function (Builder $query) {
                return $query->where('user_id', $this->user->id);
            })
            ->when($this->user->hasRole(User::PROVIDER_ROLE), function (Builder $query) {
                return $query->whereIn('branch_id', $this->user->branches->pluck('id'));
            })
            ->when($this->request->filled('status'), function (Builder $query) {
                return $query->where('status', $this->request->get('status'));
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->request->get('per_page', 10));
    }
}
