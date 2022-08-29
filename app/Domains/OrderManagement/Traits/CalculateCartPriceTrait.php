<?php

namespace App\Domains\OrderManagement\Traits;

use App\Domains\OrderManagement\Models\Cart;

trait CalculateCartPriceTrait
{

    public function calculate(Cart $cart, array $attributes = []):array
    {
        $deliveryFee = data_get($cart->branch->delivery_data,'cost');
        $subTotal = $cart->items->sum('sub_total');

        return array_merge([
            'total' => $subTotal + $deliveryFee,
            'subtotal' => $subTotal,
            'delivery' => $deliveryFee,
            'discount' => 0,
            'vat' => 0,
        ],$attributes);
    }
}
