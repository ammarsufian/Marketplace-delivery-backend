<?php

namespace App\Domains\AccountManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserAddressRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'is_default' => ['required', 'boolean'],
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
            'city_name' => ['required', 'string'],
        ];
    }
}
