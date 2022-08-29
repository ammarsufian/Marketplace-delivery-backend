<?php

namespace App\Domains\OrderManagement\Rules;

use App\Domains\Interfaces\Rulable;
use App\Domains\OrderManagement\Models\PromoCode;
use Carbon\Carbon;

class CheckPromoCodeValidityRule implements Rulable
{
    protected ?PromoCode $promoCode;
    protected Carbon $currentDateTime;

    public function __construct(?PromoCode $promoCode)
    {
        $this->promoCode = $promoCode;
        $this->currentDateTime = Carbon::now();
    }

    public function run(): bool
    {
        if (!$this->promoCode)
            return true;

        return $this->promoCode->start_datetime <= $this->currentDateTime
            && $this->promoCode->end_datetime >= $this->currentDateTime;
    }

    public function getMessage(): string
    {
        return 'Promo Code is Expired or not started yet';
    }
}
