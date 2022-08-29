<?php

namespace App\Domains\ApplicationManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VersionCheckRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'operating_system' => ['required']
        ];
    }
}
