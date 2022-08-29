<?php

namespace App\Domains\Transaction\Actions;
use App\Domains\Interfaces\Actionable;
use App\Domains\Transaction\Models\CreditCard;

class DeleteCreditCardAction implements Actionable
{
    protected CreditCard $creditCard;

    public function __construct(CreditCard $creditCard)
    {
        $this->creditCard = $creditCard;
    }

    public function execute() : bool
    {
        return $this->creditCard->delete();
    }
}
