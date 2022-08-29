<?php

namespace App\Domains\OrderManagement\Services;

use App\Domains\OrderManagement\Http\Requests\ApplyPromoCodeRequest;
use App\Domains\OrderManagement\Models\PromoCode;
use App\Domains\OrderManagement\Rules\CheckCartItemsCountRule;
use App\Domains\OrderManagement\Rules\CheckPromoCodeValidityRule;
use App\Domains\OrderManagement\Rules\CheckRemainingPromoCodeCounterRule;
use App\Rules\Rules;
use Exception;
use Illuminate\Support\Facades\Auth;

class PromoCodeService
{

    public function applyPromoCode(ApplyPromoCodeRequest $request)
    {
        try {
            $promoCode = PromoCode::query()->ofPromoCode($request->get('promo_code'))->first();
            $cart = Auth::user()->cart;

            $ruleResults = Rules::apply([
                (new CheckPromoCodeValidityRule($promoCode)),
                (new CheckCartItemsCountRule()),
                (new CheckRemainingPromoCodeCounterRule($promoCode)),
            ]);

            if($ruleResults->hasFailures())
                $ruleResults->toException();

            $cart->update(['promo_code_id'=>$promoCode->id]);
            $results = (new $promoCode->type($promoCode,$cart->refresh()))->execute();

        }catch (Exception $exception)
        {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false,
            ],400);
        }

        return response()->json(['data'=>$results]);
    }
}
