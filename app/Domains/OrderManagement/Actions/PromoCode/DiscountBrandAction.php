<?php

namespace App\Domains\OrderManagement\Actions\PromoCode;

use App\Domains\Interfaces\Actionable;
use App\Domains\OrderManagement\Models\Cart;
use App\Domains\OrderManagement\Models\PromoCode;
use App\Domains\OrderManagement\Traits\CalculateCartPriceTrait;

class DiscountBrandAction implements Actionable
{
    use CalculateCartPriceTrait;

    protected PromoCode $promoCode;
    protected Cart $cart;

    public function __construct(PromoCode $promoCode, Cart $cart)
    {
        $this->promoCode = $promoCode;
        $this->cart = $cart;
    }

    public function execute()
    {
        // TODO: Implement execute() method.
    }
}
