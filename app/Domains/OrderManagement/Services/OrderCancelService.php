<?php

namespace App\Domains\OrderManagement\Services;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Domains\OrderManagement\Actions\GetOrderCancelReasonListAction;
use App\Domains\OrderManagement\Http\Resources\OrderCancelReasonResource;

class OrderCancelService
{
    public function index(Request $request)
    {
        try {
            $results = (new GetOrderCancelReasonListAction($request))->execute();
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false
            ], 400);
        }
        return OrderCancelReasonResource::collection($results);
    }

}
