<?php

namespace App\Domains\OrderManagement\Rules;

use App\Domains\Interfaces\Rulable;
use Illuminate\Support\Facades\Auth;
use App\Domains\OrderManagement\Models\Order;

class CheckOrderBelongsToProviderRule implements Rulable
{

    protected Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function run(): bool
    {
        return (Auth::user()->branches()->where('branch_id', $this->order->branch_id))->exists();
    }

    public function getMessage(): string
    {
        return 'Order does not belongs to you';
    }
}
