<?php

namespace App\Domains\ProductManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEntityProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'product_id' => ['required', 'exists:products,id'],
            'unit_price' => ['required', 'numeric', 'min:1'],
            'discount' => ['nullable', 'numeric', 'min:0'],
            'variants' => ['required', 'array', 'min:1'],
            'variants.*.price' => ['required', 'numeric', 'min:1'],
            'variants.*.variant_id' => ['required', 'exists:variants,id']
        ];
    }
}
