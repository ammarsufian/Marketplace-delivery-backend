<?php

namespace App\Domains\OrderManagement\Actions;

use App\Domains\Interfaces\Actionable;
use App\Domains\OrderManagement\Models\Cart;

class DeleteCartWithItemsAction implements Actionable
{
    protected Cart $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function execute(): bool
    {
        return $this->cart->delete();
    }
}
