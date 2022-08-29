<?php

namespace App\Domains\AccountManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewJoinerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstName' => ['required','string', 'max:125','not_regex:/^\d+$/'],
            'lastName' => ['required','string', 'max:125','not_regex:/^\d+$/'],
            'city' => ['required','exists:cities,id'],
            'phoneNumber' => ['required','string','regex:/^\d+$/'],
         ];
    }

}
