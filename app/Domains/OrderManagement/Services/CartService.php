<?php

namespace App\Domains\OrderManagement\Services;

use App\Domains\AccountManagement\Models\Branch;
use App\Domains\ApplicationManagement\Models\Package;
use App\Domains\Authentication\Rules\CheckGuestRule;
use App\Domains\Authentication\Rules\CheckIfUserIsActiveRule;
use App\Domains\OrderManagement\Actions\AddItemToCartAction;
use App\Domains\OrderManagement\Actions\DeleteCartItemByIdAction;
use App\Domains\OrderManagement\Actions\GetModelByIdAction;
use App\Domains\OrderManagement\Actions\GetUserCartAction;
use App\Domains\OrderManagement\Http\Requests\AddItemToCartRequest;
use App\Domains\OrderManagement\Http\Resources\CartResource;
use App\Domains\OrderManagement\Models\CartItem;
use App\Domains\OrderManagement\Models\CartItemVariant;
use App\Domains\OrderManagement\Rules\CheckCartItemBelongsToUserRule;
use App\Exceptions\RuleResultException;
use App\Rules\Rules;
use Illuminate\Support\Facades\Auth;


class CartService
{

    public function addItemToCart(AddItemToCartRequest $request)
    {
        try {
            $user = Auth::user();
            $ruleResults = Rules::apply([
                (new CheckGuestRule($user)),
                (new CheckIfUserIsActiveRule()),
            ]);

            if ($ruleResults->hasFailures())
                $ruleResults->toException();

            $model = (new GetModelByIdAction($request->get('buyable_type'), $request->get('buyable_id')))->execute();
            $this->clearCart($model);
            if ($model instanceof Package) {
                $model->branch = Branch::first();
            }
            $cart = (new GetUserCartAction($model->branch))->execute();
            (new AddItemToCartAction($model, $cart, $request))->execute();


        } catch (RuleResultException $exception) {
            return $exception->ruleResult()->toExceptionResponse();
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false,
            ], 400);
        }

        return response()->json([
            'message' => 'success',
            'success' => true,
            'data' => CartResource::make($cart->refresh())
        ]);
    }

    public function index()
    {
        return response()->json([
            'data' => CartResource::make(Auth::user()->cart)
        ]);
    }

    public function deleteItemById(CartItem $cartItem)
    {
        try {
            $ruleResults = Rules::apply([
                (new CheckCartItemBelongsToUserRule($cartItem)),
                (new CheckIfUserIsActiveRule()),
            ]);

            if ($ruleResults->hasFailures())
                $ruleResults->toException();

            (new DeleteCartItemByIdAction($cartItem))->execute();

            if (!$cartItem->cart->items->count())
                $cartItem->cart->delete();

        } catch (RuleResultException $exception) {
            return $exception->ruleResult()->toExceptionResponse();
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false
            ], 400);
        }

        return response()->json([
            'data' => CartResource::make($cartItem->cart->refresh())
        ]);
    }

    private function clearCart($model)
    {
        if (Auth::user()->cart->branch_id != $model->branch_id) {
            $cartItems = $this->cart->items->pluk('id');
            if ($cartItems)
                CartItemVariant::whereIn('cart_item_id', $cartItems)->delete();
            $this->cart->items->delete();
            $this->cart->delete();
        }

        return true;
    }
}
