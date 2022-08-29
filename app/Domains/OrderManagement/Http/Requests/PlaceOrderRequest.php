<?php

namespace App\Domains\OrderManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaceOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'addressId' => ['required', 'exists:addresses,id'],
            'paymentMethodId' => ['required', 'exists:payment_methods,id'],
            'credit_card_id' => ['required_if:paymentMethodId,1','exists:credit_cards,id']
        ];
    }

    public function messages(): array
    {
        return [
            'addressId.exists' => "invalid address Id",
            'paymentMethodId.exists' => "invalid payment method id",
        ];
    }
}
