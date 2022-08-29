<?php

namespace App\Domains\Authentication\Http\Requests;

use App\Domains\Authentication\Rules\Requests\ValidateMobileNumberRule;
use App\Domains\Authentication\Rules\Requests\ValidateUniqueMobileNumberRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'mobile_number' => ['required', 'min:9', new ValidateUniqueMobileNumberRule()],
        ];
    }
}
