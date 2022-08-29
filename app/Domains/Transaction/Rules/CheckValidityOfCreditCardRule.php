<?php

namespace App\Domains\Transaction\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckValidityOfCreditCardRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        return substr($value,3) >= date('y') ? (substr($value,0,2)>=date('m')?true :false): false;
    }

    public function message(): string
    {
        return 'Invalid date';
    }
}
