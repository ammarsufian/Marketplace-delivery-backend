<?php

namespace App\Domains\OrderManagement\Http\Resources;

use App\Domains\OrderManagement\Traits\CalculateCartPriceTrait;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class CartResource extends JsonResource
{
    use CalculateCartPriceTrait;

    public function toArray($request)
    {
        if(!isset($this->items))
            return [];

        $cartItems = CartItemsResource::collection($this->items);
        return array_merge([
            'id' => $this->id,
            'items' => $cartItems,
            'subtotal' => collect($cartItems)->sum('subtotal'),
        ], $this->calculate(Auth::user()->cart));
    }
}
