<?php

namespace App\Domains\OrderManagement\Services;

use App\Domains\AccountManagement\Models\Address;
use App\Domains\Authentication\Rules\CheckIfUserIsActiveRule;
use App\Domains\OrderManagement\Actions\CreateOrderAction;
use App\Domains\OrderManagement\Actions\CreateOrderItemAction;
use App\Domains\OrderManagement\Actions\GetOrderListAction;
use App\Domains\OrderManagement\Http\Requests\PlaceOrderRequest;
use App\Domains\OrderManagement\Http\Resources\OrderDetailsResource;
use App\Domains\OrderManagement\Http\Resources\ClientOrderResource;
use App\Domains\OrderManagement\Models\Order;
use App\Domains\OrderManagement\Rules\CheckAddressBelongsToUserRule;
use App\Domains\OrderManagement\Rules\CheckCartItemsCountRule;
use App\Domains\OrderManagement\Rules\CheckPromoCodeValidityRule;
use App\Domains\OrderManagement\Rules\CheckRemainingPromoCodeCounterRule;
use App\Domains\Transaction\Actions\CreateOrderTransactionAction;
use App\Domains\Transaction\Models\PaymentMethod;
use App\Domains\Transaction\Rules\CheckPaymentMethodStatusRule;
use App\Exceptions\RuleResultException;
use App\Rules\Rules;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ClientOrderService
{

    public function placeOrder(PlaceOrderRequest $request)
    {
        $promoCode = Auth::user()->cart->promoCode;
        $address = Address::find($request->get('addressId'));
        $paymentMethod = PaymentMethod::find($request->get('paymentMethodId'));

        try {
            $ruleResults = Rules::apply([
                (new CheckIfUserIsActiveRule()),
                (new CheckPromoCodeValidityRule($promoCode)),
                (new CheckCartItemsCountRule()),
                (new CheckRemainingPromoCodeCounterRule($promoCode)),
                (new CheckAddressBelongsToUserRule($address)),
                (new CheckPaymentMethodStatusRule($paymentMethod)),
            ]);

            $order = (new CreateOrderAction($request, $promoCode, $address))->execute();
            (new CreateOrderItemAction($order))->execute();
            (new CreateOrderTransactionAction($order, $paymentMethod, $request->get('credit_card_id')))->execute();

            if ($ruleResults->hasFailures())
                $ruleResults->toException();

        } catch (RuleResultException $exception) {
            return $exception->ruleResult()->toExceptionResponse();
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false
            ], 400);
        }

        return ClientOrderResource::make($order);
    }

    public function index(Request $request): JsonResource
    {
        $orders = (new GetOrderListAction($request))->execute();
        return ClientOrderResource::collection($orders);
    }

    public function show(Order $order): JsonResource
    {
        return OrderDetailsResource::make($order);
    }
}
