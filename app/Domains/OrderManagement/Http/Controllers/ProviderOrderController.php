<?php

namespace App\Domains\OrderManagement\Http\Controllers;


use App\Domains\OrderManagement\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\OrderManagement\Services\ProviderOrderService;
use App\Domains\OrderManagement\Http\Requests\UpdateOrderStatusRequest;
use App\Domains\OrderManagement\Http\Requests\OrdersDateRequest;

class ProviderOrderController extends Controller
{
    public function index(Request $request, ProviderOrderService $providerOrderService)
    {
        return $providerOrderService->index($request);
    }

    public function updateStatus(Order $order, UpdateOrderStatusRequest $request, ProviderOrderService $providerOrderService)
    {
        return $providerOrderService->updateStatus($request, $order);
    }

    public function filterOrdersByDate(OrdersDateRequest $request, ProviderOrderService $providerOrderService)
    {
        return $providerOrderService->filterOrdersByDate($request);
    }
}
