<?php

namespace App\Domains\OrderManagement\Services;

use App\Domains\Authentication\Rules\CheckIfUserIsActiveRule;
use App\Domains\OrderManagement\Actions\AddItemToCartAction;
use App\Domains\OrderManagement\Actions\DeleteCartItemByIdAction;
use App\Domains\OrderManagement\Actions\GetModelByIdAction;
use App\Domains\OrderManagement\Actions\GetUserCartAction;
use App\Domains\OrderManagement\Http\Requests\AddItemToCartRequest;
use App\Domains\OrderManagement\Http\Resources\CartResource;
use App\Domains\OrderManagement\Models\CartItem;
use App\Domains\OrderManagement\Rules\CheckCartItemBelongsToUserRule;
use App\Exceptions\RuleResultException;
use App\Rules\Rules;
use Illuminate\Support\Facades\Auth;


class CartService
{

    public function addItemToCart(AddItemToCartRequest $request)
    {
        try {
            $ruleResults = Rules::apply([
                (new CheckIfUserIsActiveRule()),
            ]);

            if($ruleResults->hasFailures())
                $ruleResults->toException();

            $model = (new GetModelByIdAction($request->get('buyable_type'), $request->get('buyable_id')))->execute();
            $cart = (new GetUserCartAction($model->branch))->execute();
            (new AddItemToCartAction($model,$cart, $request))->execute();

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
        return CartResource::make(Auth::user()->cart);
    }

    public function deleteItemById(CartItem $cartItem)
    {
        try {
            $ruleResults = Rules::apply([
                (new CheckCartItemBelongsToUserRule($cartItem)),
                (new CheckIfUserIsActiveRule()),
            ]);

             if($ruleResults->hasFailures())
                    $ruleResults->toException();

            (new DeleteCartItemByIdAction($cartItem))->execute();

            if(!$cartItem->cart->items->count())
                    $cartItem->cart->delete();

        }catch (RuleResultException $exception) {
            return $exception->ruleResult()->toExceptionResponse();
        }catch(\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false
            ],400);
        }

        return CartResource::make($cartItem->cart->refresh());
    }
}
