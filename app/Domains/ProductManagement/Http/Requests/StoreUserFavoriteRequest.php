<?php

namespace App\Domains\ProductManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserFavoriteRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'entity_product_id' => ['required', 'exists:entity_products,id']
        ];
    }
}
