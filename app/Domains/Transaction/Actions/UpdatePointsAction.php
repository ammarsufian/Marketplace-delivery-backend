<?php

namespace App\Domains\Transaction\Actions;

use App\Domains\Authentication\Models\User;
use App\Domains\Interfaces\Actionable;
use App\Domains\Transaction\Models\UserTransaction;

class UpdatePointsAction implements Actionable
{
    protected UserTransaction $transaction;
    protected float $amount;
    protected string $reason;
    protected string $status;
    public function __construct(UserTransaction $transaction, string $status, string $reason)
    {
        $this->transaction = $transaction;
        $this->status = $status;
        $this->amount = UserTransaction::POINTS_AMOUNT; 
        $this->reason = $reason;
    }

    public function execute():bool
    {
        return $this->transaction->update([
            'reason' => $this->reason,
            'amount' => $this->amount,
            'status' => $this->status,
        ]);
    }
}
