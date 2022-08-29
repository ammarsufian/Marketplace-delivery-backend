<?php

namespace App\Domains\Transaction\Actions;
use App\Domains\Interfaces\Actionable;
use App\Domains\Transaction\Http\Requests\CreateCreditCardRequest;
use App\Domains\Transaction\Models\CreditCard;
use App\Domains\Transaction\Models\CreditCardCompany;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateCreditCardAction implements Actionable
{
    protected Request $request;

    public function __construct(CreateCreditCardRequest $request)
    {
        $this->request = $request;
    }

    public function execute() : CreditCard
    {
        return Auth::user()->creditCards()->create([
            'card_number' => $this->request->get('card_number'),
            'name' => $this->request->get('name'),
            'cvv' => $this->request->get('cvv'),
            'expiration_date' => $this->request->get('expiration_date'),
            'company_id' => $this->request->get('card_number')
        ]);
    }
}
