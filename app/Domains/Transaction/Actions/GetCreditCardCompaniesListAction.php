<?php

namespace App\Domains\Transaction\Actions;

use App\Domains\Interfaces\Actionable;
use App\Domains\Transaction\Models\CreditCardCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class GetCreditCardCompaniesListAction implements Actionable
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function execute(): Collection
    {
        return CreditCardCompany::all();
    }
}