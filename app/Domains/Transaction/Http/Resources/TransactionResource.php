<?php

namespace App\Domains\Transaction\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'paymentMethod' => PaymentMethodResource::make($this->paymentMethod),
            'status' => $this->status,
            'total' => $this->amount,
            'creditCard' => CreditCardResource::make($this->creditCard),
        ];
    }
}
