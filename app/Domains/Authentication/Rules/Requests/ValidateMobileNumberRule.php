<?php

namespace App\Domains\Authentication\Rules\Requests;

use App\Domains\Authentication\Models\User;
use Illuminate\Contracts\Validation\Rule;
use function App\Helpers\mobile;

class ValidateMobileNumberRule implements Rule
{

    public function passes($attribute, $value): bool
    {
        return User::where('mobile_number', mobile($value))->exists();
    }

    public function message(): string
    {
        return 'The mobile number does not exists';
    }
}
