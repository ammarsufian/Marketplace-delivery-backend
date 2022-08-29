<?php

namespace App\Domains\OrderManagement\Actions\PromoCode;

use App\Domains\Interfaces\Actionable;
use App\Domains\OrderManagement\Models\Cart;
use App\Domains\OrderManagement\Models\PromoCode;
use App\Domains\OrderManagement\Traits\CalculateCartPriceTrait;
use App\Domains\Transaction\Actions\CreateUserTransactionAction;
use Illuminate\Support\Facades\Auth;

class CashBackAction implements Actionable
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
        (new CreateUserTransactionAction(
            $this->promoCode->value,
            "Cash Back Promo Code :{$this->promoCode->promo_code}",
            true,
        ))->execute();

        $this->calculate($this->cart, [
            'message' => "Cova add {$this->promoCode->value} points to your wallet"
        ]);
    }
}
