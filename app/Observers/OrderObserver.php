<?php

namespace App\Observers;

use App\Domains\OrderManagement\Models\Order;
use App\Domains\Transaction\Actions\CreateUserTransactionAction;
use App\Domains\Transaction\Models\UserTransaction;
use App\Domains\Transaction\Actions\CreatePointsAction;
use App\Domains\Transaction\Actions\UpdateUserTransactionAction;

class OrderObserver
{
    /**
     * Handle the Order "updated" event.
     *
     * @param \App\Domains\OrderManagement\Models\Order $order
     * @return void
     */
    public function updated(Order $order)
    {
        if ($order->status === Order::DELIVERED_ORDER_STATUS) {
            $userTransaction = UserTransaction::where('user_id', $order->user_id)
                ->where('status', UserTransaction::POINTS_STATUS_WAITING_FOR_ORDER)->first();
            if ($userTransaction) {
                (new CreateUserTransactionAction($userTransaction->invitation_sender_id,UserTransaction::POINTS_AMOUNT,
                    UserTransaction::POINTS_REASON,UserTransaction::POINTS_STATUS_ACCEPTED,true))->execute();
                (new UpdateUserTransactionAction($userTransaction, UserTransaction::POINTS_STATUS_ACCEPTED))->execute();
            }
        }
    }

}
