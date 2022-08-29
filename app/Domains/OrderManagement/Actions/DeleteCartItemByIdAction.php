<?php

namespace App\Domains\OrderManagement\Actions;

use App\Domains\Interfaces\Actionable;
use App\Domains\OrderManagement\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class DeleteCartItemByIdAction implements Actionable
{
    protected CartItem $cartItem;

    public function __construct(CartItem $cartItem)
    {
        $this->cartItem = $cartItem;
    }

    public function execute(): bool
    {
        $this->cartItem->variants()->detach();
        return Auth::user()->cart->items()->where('id', $this->cartItem->id)->delete();
    }
}
