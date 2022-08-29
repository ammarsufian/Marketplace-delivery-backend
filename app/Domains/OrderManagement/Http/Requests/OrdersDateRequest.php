<?php

namespace App\Domains\OrderManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrdersDateRequest extends FormRequest
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
            'date'=>['nullable', 'date_format:Y-m-d'],
        ];
    }
}
