<?php

namespace App\Domains\Authentication\Rules\Requests;

use App\Domains\Authentication\Models\User;
use Illuminate\Contracts\Validation\Rule;
use function App\Helpers\mobile;

class ValidateUniqueMobileNumberRule implements Rule
{

    public function passes($attribute, $value): bool
    {
        return !User::where('mobile_number', mobile($value))->exists();
    }

    public function message(): string
    {
        return 'Mobile Number already exists';
    }
}
