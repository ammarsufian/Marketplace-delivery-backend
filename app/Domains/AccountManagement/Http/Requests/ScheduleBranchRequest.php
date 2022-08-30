<?php

namespace App\Domains\AccountManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ScheduleBranchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'schedule' => 'nullable|array|min:1|max:7',
            'schedule.*.*.*' => 'nullable|string|date_format:H:i',
            'schedule.*.*.start' => 'before:schedule.*.*.end',
            'schedule.*.*.end' => 'after:schedule.*.*.start',
        ];
    }
}
