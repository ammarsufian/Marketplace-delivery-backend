<?php

namespace App\Domains\AccountManagement\Http\Requests;

use App\Domains\AccountManagement\Models\Address;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserAddressRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'latitude' => ['required'],
            'longitude' => ['required'],
            'type' => ['required'],
            'is_default' => ['required', 'boolean'],
            'city_name' => ['required'],
            'details' => ['required']
        ];
    }
}
