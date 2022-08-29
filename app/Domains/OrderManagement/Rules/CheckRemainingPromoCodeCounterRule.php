<?php

namespace App\Domains\OrderManagement\Rules;

use App\Domains\Interfaces\Rulable;
use App\Domains\OrderManagement\Models\PromoCode;

class CheckRemainingPromoCodeCounterRule implements Rulable
{
    protected ?PromoCode $promoCode;

    public function __construct(?PromoCode $promoCode)
    {
        $this->promoCode = $promoCode;
    }

    public function run(): bool
    {
        if (!$this->promoCode)
            return true;

        return (bool)$this->promoCode->counter;
    }

    public function getMessage(): string
    {
        return 'This promo code is already reached the limit ';
    }
}
