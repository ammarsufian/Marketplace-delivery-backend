<?php

namespace App\Domains\OrderManagement\Http\Controllers;

use App\Domains\OrderManagement\Http\Requests\AddItemToCartRequest;
use App\Domains\OrderManagement\Models\CartItem;
use App\Domains\OrderManagement\Services\CartService;
use App\Http\Controllers\Controller;

class CartController extends Controller
{

    public function store(AddItemToCartRequest $request, CartService $cartService)
    {
        return $cartService->addItemToCart($request);
    }

    public function index(CartService $cartService)
    {
        return $cartService->index();
    }
}
