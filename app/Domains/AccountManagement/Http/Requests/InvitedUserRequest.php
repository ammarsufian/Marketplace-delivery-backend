<?php

namespace App\Domains\AccountManagement\Http\Requests;

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
            'firstName' => ['required','string'],
            'lastName' => ['required','string'],
            'email' => ['required','email','unique:users,email'],
            'mobileNumber' => ['required','string','unique:users,mobile_number'],
            'invitedId'=>['required','exists:users,id'],
        ];
    }
}