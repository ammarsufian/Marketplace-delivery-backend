<?php

namespace App\Domains\OrderManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplyPromoCodeRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'promo_code' => ['required', 'exists:promo_codes,promo_code']
        ];
    }

    public function messages(): array
    {
        return [
            'promo_code.exists' => "invalid promo code",
        ];
    }
}
