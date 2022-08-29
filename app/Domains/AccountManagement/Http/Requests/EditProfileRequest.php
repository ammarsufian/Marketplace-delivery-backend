<?php
namespace App\Domains\AccountManagement\Http\Requests;

use App\Domains\Authentication\Rules\Requests\ValidateMobileNumberWithIgnoreActiveUserRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EditProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['nullable','string', 'max:255'],
            'email' => ['nullable','email',Rule::unique('users','email')->ignore(Auth::user()->id)],
            'mobile_number' => ['nullable','string',new ValidateMobileNumberWithIgnoreActiveUserRule()],
        ];
    }

    public function messages():array
    {
        return [
            'name.max' => __('general.authentication.invalid_password')//TODO::make all params validation messages
        ];
    }
}
