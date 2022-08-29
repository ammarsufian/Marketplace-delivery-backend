<?php

namespace App\Domains\OrderManagement\Actions;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Domains\Interfaces\Actionable;
use App\Domains\OrderManagement\Http\Requests\UpdateOrderStatusRequest;
use App\Domains\OrderManagement\Models\Order;


class UpdateOrderStatusAction implements Actionable
{
    protected Request $request;
    protected Order $order;

    function __construct(UpdateOrderStatusRequest $request, Order $order)
    {
        $this->request = $request;
        $this->order = $order;
    }

    public function execute(): bool
    {
        $attributes = []; //TODO::make refactoring for this logic
        if ($this->request->get('status') === Order::PREPARING_ORDER_STATUS) {
            $attributes = [
                'preparation_time' => Carbon::now()->addMinutes($this->request->get('preparation_time')),
            ];
        }
        if ($this->request->get('status') === Order::REJECT_ORDER_STATUS) {
            $attributes = [
                'cancel_reason_id' => $this->request->get('cancel_reason_id'),
            ];
        }

        return $this->order->update(array_merge([
            'status' => $this->request->get('status'),
        ], $attributes));
    }

}
