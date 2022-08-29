<?php

namespace App\Domains\OrderManagement\Actions;

use App\Domains\Interfaces\Actionable;
use App\Domains\OrderManagement\Models\Cart;
use App\Domains\OrderManagement\Models\CartItem;
use App\Domains\OrderManagement\Models\Order;
use App\Domains\ProductManagement\Models\EntityProductVariants;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CreateOrderItemAction implements Actionable
{
    protected Order $order;
    protected Cart $cart;

    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->cart = Auth::user()->cart;
    }

    public function execute(): Collection
    {
        return collect($this->cart->items)->each(function (CartItem $cartItem) {
            $orderItem = $this->order->items()->create([
                'buyable_id' => $cartItem->buyable_id,
                'buyable_type' => $cartItem->buyable_type,
                'unit_price' => $cartItem->buyable->unit_price,
                'quantity' => $cartItem->quantity,
                'total' => $cartItem->sub_total,
                'discount' => 0,
                'vat' => 0,
            ]);

            $cartItem->variants
                ->each(function ($variant) use ($orderItem) {
                    $orderItem->variants()->attach(
                        $variant->id,
                        ['price' => $variant->pivot->price]
                    );
                });
        });
    }
}
