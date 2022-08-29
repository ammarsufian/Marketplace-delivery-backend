<?php

namespace App\Domains\OrderManagement\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\OrderManagement\Services\OrderCancelService;

class OrderCancelReasonListController extends Controller
{

   public function __invoke(Request $request, OrderCancelService $orderCancelService)
    {
        return $orderCancelService->index($request);
    }
}
