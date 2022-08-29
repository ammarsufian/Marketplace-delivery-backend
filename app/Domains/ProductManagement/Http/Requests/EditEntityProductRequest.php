<?php

namespace App\Domains\ProductManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditEntityProductRequest extends FormRequest
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
            'unit_price' => ['nullable', 'numeric', 'min:1'],
            'discount' => ['nullable', 'numeric', 'min:0'],
            'variants' => ['required', 'array', 'min:1'],
            'variants.*.price' => ['required', 'numeric'],
            'variants.*.variant_id' => ['required', 'exists:variants,id']
        ];
    }
}
