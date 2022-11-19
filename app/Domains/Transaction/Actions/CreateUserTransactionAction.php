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
    protected ?string $status;
    protected int $user_id;

    public function __construct(int $user_id, float $amount, string $reason, ?string $status = null, bool $isPlus = false)
    {
        $this->user_id = $user_id;
        $this->amount = $amount;
        $this->reason = $reason;
        $this->isPlus = $isPlus;
        $this->status = $status ?? UserTransaction::POINTS_STATUS_PENDING;
    }

    public function execute(): UserTransaction
    {
        return UserTransaction::create([
            'user_id' => $this->user_id,
            'reason' => $this->reason,
            'status' => $this->status,
            'amount' => $this->isPlus ? $this->amount : $this->amount * -1,

        ]);
    }
}
