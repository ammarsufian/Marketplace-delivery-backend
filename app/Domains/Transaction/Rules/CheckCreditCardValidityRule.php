<?php

namespace App\Domains\Transaction\Rules;

use App\Domains\Interfaces\Rulable;
use Carbon\Carbon;

class CheckCreditCardValidityRule implements Rulable
{
    protected Carbon $expirationDate;

    public function __construct(string $expirationDate)
    {
        $this->expirationDate = Carbon::createFromFormat('m/y',$expirationDate);
    }

    public function run(): bool
    {
       return $this->expirationDate > Carbon::now();
    }

    public function getMessage(): string
    {
        return 'Invalid expiry date';// TODO: add translation for this message
    }
}
