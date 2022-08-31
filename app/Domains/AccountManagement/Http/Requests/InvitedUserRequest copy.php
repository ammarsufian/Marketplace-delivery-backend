<?php

namespace App\Domains\AccountManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CreateInvitedUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'sms'=>['required'],
        ];
    }
}