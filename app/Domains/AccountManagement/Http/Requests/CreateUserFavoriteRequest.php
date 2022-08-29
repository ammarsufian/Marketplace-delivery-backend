<?php

namespace App\Domains\AccountManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserFavoriteRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'branch_id' => ['required', 'exists:branches,id']
        ];
    }
}
