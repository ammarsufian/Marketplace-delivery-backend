<?php

namespace App\Domains\Transaction\Http\Controllers;

use App\Domains\Transaction\Services\PaymentMethodService;
use Illuminate\Routing\Controller;

class PaymentMethodController extends Controller
{

    public function __invoke(PaymentMethodService $paymentMethodService)
    {
        return $paymentMethodService->index();
    }
}
