<?php


namespace App\Domains\Transaction\Rules;

use App\Domains\Transaction\Models\CreditCard;
use App\Domains\Interfaces\Rulable;
use Illuminate\Support\Facades\Auth;


class CheckCreditCardBelongsToUser implements Rulable
{
    protected CreditCard $creditCard;

    public function __construct(CreditCard $creditCard)
    {
        $this->creditCard = $creditCard;
    }

    public function run(): bool
    {
        return $this->creditCard->user_id === Auth::user()->id;
    }

    public function getMessage(): string
    {
        return 'Credit Card Dose not belongs to active user'; //TODO::to be translatable by data team
    }
}
