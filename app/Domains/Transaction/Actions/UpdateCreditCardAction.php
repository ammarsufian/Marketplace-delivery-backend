<?php

namespace App\Domains\Transaction\Actions;
use App\Domains\Interfaces\Actionable;
use App\Domains\Transaction\Http\Requests\UpdateCreditCardRequest;
use App\Domains\Transaction\Models\CreditCard;
use Illuminate\Http\Request;

class UpdateCreditCardAction implements Actionable
{
    protected CreditCard $creditCard;
    protected Request $request;

    public function __construct(CreditCard $creditCard ,UpdateCreditCardRequest $request)
    {
        $this->creditCard = $creditCard;
        $this->request = $request;
    }

    public function execute() : bool
    {
       return  $this->creditCard->update([
           'card_number' => $this->request->get('card_number'),
           'name' => $this->request->get('name'),
           'cvv' => $this->request->get('cvv'),
           'expiration_date' => $this->request->get('expiration_date'),
           'company_id' => $this->request->get('card_number')
       ]);
    }
}
