<?php

namespace App\Domains\OrderManagement\Actions\PromoCode;

use App\Domains\Interfaces\Actionable;
use App\Domains\OrderManagement\Models\Cart;
use App\Domains\OrderManagement\Models\PromoCode;
use App\Domains\OrderManagement\Traits\CalculateCartPriceTrait;
use Illuminate\Support\Facades\Auth;

class DeliveryPriceDiscountAction implements Actionable
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
        $discounted = $this->checkDeliveryFee();

        return $this->calculate($this->cart, [
            'delivery' => $discounted,
            'total' => $this->cart->items->sum('sub_total') + $discounted,
        ]);
    }

    protected function checkDeliveryFee()
    {
        if ($this->deliveryFee >= $this->promoCode->value)
            return $this->deliveryFee - $this->promoCode->value;

        return 0;
    }
}
