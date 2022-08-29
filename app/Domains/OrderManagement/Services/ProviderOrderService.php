<?php

namespace App\Domains\OrderManagement\Services;

use Exception;
use App\Rules\Rules;
use Illuminate\Http\Request;
use App\Exceptions\RuleResultException;
use App\Domains\OrderManagement\Models\Order;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Domains\OrderManagement\Actions\GetOrderListAction;
use App\Domains\OrderManagement\Actions\GetOrdersByDateAction;
use App\Domains\OrderManagement\Actions\UpdateOrderStatusAction;
use App\Domains\OrderManagement\Http\Requests\OrdersDateRequest;
use App\Domains\OrderManagement\Http\Resources\ProviderOrderResource;
use App\Domains\OrderManagement\Rules\CheckOrderBelongsToProviderRule;
use App\Domains\OrderManagement\Http\Requests\UpdateOrderStatusRequest;

class ProviderOrderService
{

    public function index(Request $request): JsonResource
    {
        $orderList = (new GetOrderListAction($request))->execute();
        return ProviderOrderResource::collection($orderList);
    }

    public function updateStatus(UpdateOrderStatusRequest $request, Order $order)
    {
        try {
            $ruleResult = Rules::apply([
                (new CheckOrderBelongsToProviderRule($order))
            ]);

            if ($ruleResult->hasFailures()) {
                $ruleResult->toException();
            }

            (new UpdateOrderStatusAction($request, $order))->execute();
        } catch (RuleResultException $exception) {
            return $exception->ruleResult()->toExceptionResponse();
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false,
            ], 400);
        }

        return response()->json([
            'message' => 'Reject order success',
            'success' => true,
            'data' => ProviderOrderResource::make($order->refresh())
        ]);
    }

    public function filterOrdersByDate(OrdersDateRequest $request): JsonResource
    {
        $orderList = (new GetOrdersByDateAction($request))->execute();
        return ProviderOrderResource::collection($orderList);
    }
}
