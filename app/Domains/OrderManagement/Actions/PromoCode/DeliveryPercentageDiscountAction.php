<?php

namespace App\Domains\OrderManagement\Actions\PromoCode;

use App\Domains\Interfaces\Actionable;
use App\Domains\OrderManagement\Models\Cart;
use App\Domains\OrderManagement\Models\PromoCode;
use App\Domains\OrderManagement\Traits\CalculateCartPriceTrait;
use Illuminate\Support\Facades\Auth;

class DeliveryPercentageDiscountAction implements Actionable
{
    use CalculateCartPriceTrait;

    protected PromoCode $promoCode;
    protected Cart $cart;
    protected float $deliveryFee;

    public function __construct(PromoCode $promoCode, Cart $cart)
    {
        $this->promoCode = $promoCode;
        $this->cart = $cart;
        $this->deliveryFee = data_get($this->cart->branch->delivery_data, 'cost');
    }

    public function execute(): array
    {
        $this->deliveryFee = $this->deliveryFee - $this->deliveryFee * ($this->promoCode->value / 100);

        return $this->calculate($this->cart, [
            'delivery' => $this->deliveryFee,
            'total' => $this->cart->items->sum('sub_total') + $this->deliveryFee,
        ]);
    }
}

