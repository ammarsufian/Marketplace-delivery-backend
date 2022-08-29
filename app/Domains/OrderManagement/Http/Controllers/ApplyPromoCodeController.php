<?php

namespace App\Domains\OrderManagement\Http\Controllers;

use App\Domains\OrderManagement\Http\Requests\ApplyPromoCodeRequest;
use App\Domains\OrderManagement\Services\PromoCodeService;
use App\Http\Controllers\Controller;

class ApplyPromoCodeController extends Controller
{

    public function __invoke(ApplyPromoCodeRequest $request, PromoCodeService $promoCodeService)
    {
        return $promoCodeService->applyPromoCode($request);
    }
}
