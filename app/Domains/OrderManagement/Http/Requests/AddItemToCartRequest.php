<?php

namespace App\Domains\OrderManagement\Http\Requests;

use App\Domains\OrderManagement\Models\CartItem;
use App\Domains\OrderManagement\Rules\Requests\ValidateBuyableIdRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddItemToCartRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'quantity' => ['required', 'min:1'],
            'buyable_type' => ['required', Rule::in(array_keys(CartItem::BUYABLE_MODELS))],
            'buyable_id' => ['required', new ValidateBuyableIdRule()],
            'variants' => ['nullable', 'array'],
            'variants.*' => ['exists:variants,id'],
            'note' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'buyable_type.in' => "Invalid buyable type",
            'variants.*.exists' => "invalid variant id",
        ];
    }
}
