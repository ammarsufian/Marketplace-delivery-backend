<?php

namespace App\Domains\Transaction\Actions;

use App\Domains\Authentication\Models\User;
use App\Domains\Interfaces\Actionable;
use App\Domains\Transaction\Models\UserTransaction;

class UpdateUserTransactionAction implements Actionable
{
    protected UserTransaction $transaction;
    protected string $status;
    public function __construct(UserTransaction $transaction,string $status)
    {
        $this->transaction = $transaction;
        $this->status = $status;
    }

    public function execute():bool
    {
        return $this->transaction->update([
            'status' => $this->status,
        ]);
    }
}
