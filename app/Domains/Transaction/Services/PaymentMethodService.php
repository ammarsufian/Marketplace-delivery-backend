<?php

namespace App\Domains\Transaction\Services;

use App\Domains\Transaction\Http\Resources\PaymentMethodResource;
use App\Domains\Transaction\Models\PaymentMethod;

class PaymentMethodService
{

    public function index()
    {
        $paymentMethods = PaymentMethod::ofActive()->get();
        return PaymentMethodResource::collection($paymentMethods);
    }
}
