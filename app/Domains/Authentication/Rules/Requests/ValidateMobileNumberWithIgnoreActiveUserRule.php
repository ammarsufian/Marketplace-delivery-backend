<?php

namespace App\Domains\Authentication\Rules\Requests;

use App\Domains\Authentication\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use function App\Helpers\mobile;

class ValidateMobileNumberWithIgnoreActiveUserRule implements Rule
{

    public function passes($attribute, $value): bool
    {
        return !User::where('mobile_number', mobile($value))->where('id','!=',Auth::user()->id)->exists();
    }

    public function message(): string
    {
        return 'Mobile Number already exists';
    }
}
