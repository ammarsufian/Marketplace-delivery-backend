<?php

namespace App\Domains\OrderManagement\Actions;

use App\Domains\Interfaces\Actionable;
use App\Domains\OrderManagement\Models\PromoCode;

class UpdateRemainingCountForPromoCode implements Actionable
{
    protected PromoCode $promoCode;

    public function __construct($promoCode)
    {
        $this->promoCode = $promoCode;
    }

    public function execute(): bool
    {
        return $this->promoCode->update(['counter' => $this->promoCode->counter - 1]);
    }
}
