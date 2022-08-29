<?php

namespace App\Domains\OrderManagement\Http\Controllers;

use App\Domains\OrderManagement\Models\CartItem;
use App\Domains\OrderManagement\Services\CartService;
use App\Http\Controllers\Controller;

class DeleteCartItemController extends Controller
{

    public function __invoke(CartItem $cartItem, CartService $cartService)
    {
        return $cartService->deleteItemById($cartItem);
    }
}
