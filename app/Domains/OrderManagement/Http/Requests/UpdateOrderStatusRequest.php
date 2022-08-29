<?php

namespace App\Domains\OrderManagement\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Domains\OrderManagement\Models\Order;

class UpdateOrderStatusRequest extends FormRequest
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
            'status' => [
                'required',
                Rule::in([
                    Order::REJECT_ORDER_STATUS,
                    Order::PREPARING_ORDER_STATUS,
                ]),
            ],
            'preparation_time' => ['required_if:status,==,'.Order::PREPARING_ORDER_STATUS,'integer', 'min:0'],
            'cancel_reason_id' => ['required_if:status,==,'.Order::REJECT_ORDER_STATUS],
        ];
    }
}
