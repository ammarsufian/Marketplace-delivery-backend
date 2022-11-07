<?php

namespace App\Domains\AccountManagement\Http\Requests;

use App\Domains\Authentication\Rules\Requests\ValidateUniqueMobileNumberRule;
use Illuminate\Foundation\Http\FormRequest;


class InvitedUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'mobile_number' => ['required', 'string','regex:/^([0-9\s\-\+\(\)]*)$/',new ValidateUniqueMobileNumberRule()],
            'referral_key' => ['required', 'exists:users,referral_key'],
        ];
    }
}
