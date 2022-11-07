<?php

namespace App\Domains\Transaction\Actions;

use App\Domains\Authentication\Models\User;
use App\Domains\Interfaces\Actionable;
use App\Domains\Transaction\Models\UserTransaction;

class CreatePointsAction implements Actionable
{
    protected User $user;
    protected float $amount;
    protected string $reason;
    protected string $status;
    public function __construct(User $user, string $status, string $reason)
    {
        $this->user = $user;
        $this->status = $status;
        $this->amount = UserTransaction::POINTS_AMOUNT; 
        $this->reason = $reason;
    }

    public function execute():UserTransaction
    {
        return $this->user->transactions()->create([
            'reason' => $this->reason,
            'amount' => $this->amount,
            'status' => $this->status,
        ]);
    }
}
