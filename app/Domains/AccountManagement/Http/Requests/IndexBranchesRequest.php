<?php

namespace App\Domains\AccountManagement\Http\Requests;

use App\Domains\AccountManagement\Models\Branch;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexBranchesRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'addressId' => ['required','exists:addresses,id'],
            'type' => ['required','string',Rule::in(Branch::BRANCH_TYPES)]
        ];
    }
}
