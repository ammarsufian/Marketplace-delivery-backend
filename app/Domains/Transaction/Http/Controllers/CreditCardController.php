<?php

namespace App\Domains\Transaction\Http\Controllers;

use App\Domains\Transaction\Http\Requests\CreateCreditCardRequest;
use App\Domains\Transaction\Http\Requests\UpdateCreditCardRequest;
use App\Domains\Transaction\Models\CreditCard;
use App\Domains\Transaction\Services\CreditCardService;
use App\Http\Controllers\Controller;

class CreditCardController extends Controller
{
    public function store(CreateCreditCardRequest $request, CreditCardService $creditCardService)
    {
        return $creditCardService->create($request);
    }

    public function index(CreditCardService $creditCardService)
    {
        return $creditCardService->index();
    }

    public function update(CreditCard $creditCard,UpdateCreditCardRequest $request, CreditCardService $creditCardService)
    {
        return $creditCardService->update($creditCard,$request);
    }

    public function destroy(CreditCard $creditCard, CreditCardService $creditCardService)
    {
        return $creditCardService->delete($creditCard);
    }
}
