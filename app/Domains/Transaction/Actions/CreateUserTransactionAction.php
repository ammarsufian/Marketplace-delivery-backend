<?php

namespace App\Domains\Transaction\Actions;

use App\Domains\Interfaces\Actionable;
use App\Domains\Transaction\Models\UserTransaction;
use Illuminate\Support\Facades\Auth;

class CreateUserTransactionAction implements Actionable
{
    protected string $reason;
    protected float $amount;
    protected bool $isPlus;

    public function __construct(float $amount,string $reason,bool $isPlus = false)
    {
        $this->amount = $amount;
        $this->reason = $reason;
        $this->isPlus = $isPlus;
    }

    public function execute():UserTransaction
    {
        return Auth::user()->transactions()->create([
            'reason' => $this->reason,
            'amount' => $this->isPlus ? $this->amount : $this->amount * -1,
        ]);
    }
}
