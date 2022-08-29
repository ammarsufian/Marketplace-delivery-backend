<?php

namespace App\Domains\Transaction\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCreditCardRequest extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'card_number' =>['required'],
            'cvv' => ['required'],
            'name' => ['required'],
            'expiration_date' => ['required']
        ];
    }
}
