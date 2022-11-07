<?php

namespace App\Observers;

use App\Domains\OrderManagement\Models\Order;
use App\Domains\Transaction\Models\UserTransaction;
use App\Domains\Transaction\Actions\CreatePointsAction;
use App\Domains\Transaction\Actions\UpdatePointsAction;

class OrderObserver
{
    /**
     * Handle the Order "updated" event.
     *
     * @param  \App\Domains\OrderManagement\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        $user=$order->user;
        $userTransaction=$user->userTransactions->where('status',UserTransaction::POINTS_STATUS_PENDING)->first();
        if ($order->status===Order::DELIVERED_ORDER_STATUS && $user->invitation_sender_id) {
            if($userTransaction->status===UserTransaction::POINTS_STATUS_PENDING){
                (new CreatePointsAction($user->sender,UserTransaction::POINTS_STATUS_ACCEPTED,UserTransaction::POINTS_REASON))->execute();
                (new UpdatePointsAction($userTransaction,UserTransaction::POINTS_STATUS_ACCEPTED,UserTransaction::POINTS_REASON))->execute();    
            }
        }
    }

}
