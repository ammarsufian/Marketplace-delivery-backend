<?php

namespace App\Domains\OrderManagement\Rules;

use App\Domains\Interfaces\Rulable;
use App\Domains\OrderManagement\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CheckCartItemBelongsToUserRule implements Rulable
{
    protected CartItem $cartItem;

    public function __construct(CartItem $cartItem)
    {
        $this->cartItem = $cartItem;
    }

    public function run(): bool
    {
        return in_array($this->cartItem->id, Auth::user()->cart->items->pluck('id')->toArray());
    }

    public function getMessage(): string
    {
        return 'Invalid Cart Item id';
    }
}
