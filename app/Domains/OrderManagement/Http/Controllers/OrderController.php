<?php

namespace App\Domains\OrderManagement\Http\Controllers;

use App\Domains\OrderManagement\Http\Requests\PlaceOrderRequest;
use App\Domains\OrderManagement\Models\Order;
use App\Domains\OrderManagement\Services\ClientOrderService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function store(PlaceOrderRequest $request, ClientOrderService $orderService)
    {
        return $orderService->placeOrder($request);
    }

    public function index(Request $request, ClientOrderService $orderService)
    {
        return $orderService->index($request);
    }

    public function show(Order $order, ClientOrderService $orderService)
    {
        return $orderService->show($order);
    }
}
