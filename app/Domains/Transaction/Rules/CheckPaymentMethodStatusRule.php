<?php

namespace App\Domains\Transaction\Rules;

use App\Domains\Interfaces\Rulable;
use App\Domains\Transaction\Models\PaymentMethod;

class CheckPaymentMethodStatusRule implements Rulable
{
    protected PaymentMethod $paymentMethod;

    public function __construct(PaymentMethod $paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    public function run(): bool
    {
        return $this->paymentMethod->is_active ;
    }

    public function getMessage(): string
    {
        return 'Payment method dose not allowed';
    }
}
