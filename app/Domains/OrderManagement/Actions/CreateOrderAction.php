<?php

namespace App\Domains\OrderManagement\Actions;

use App\Domains\AccountManagement\Models\Address;
use App\Domains\Interfaces\Actionable;
use App\Domains\OrderManagement\Http\Requests\PlaceOrderRequest;
use App\Domains\OrderManagement\Models\Cart;
use App\Domains\OrderManagement\Models\Order;
use App\Domains\OrderManagement\Models\PromoCode;
use App\Domains\OrderManagement\Traits\CalculateCartPriceTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateOrderAction implements Actionable
{
    use CalculateCartPriceTrait;

    protected Request $request;
    protected array $calculations;
    protected ?PromoCode $promoCode;
    protected Address $address;
    protected Cart $cart;

    public function __construct(PlaceOrderRequest $request,?PromoCode $promoCode,Address $address)
    {
        $this->request = $request;
        $this->cart = Auth::user()->cart;
        $this->calculations = isset($promoCode)?
            (new $promoCode->type($promoCode,$this->cart))->execute():$this->calculate($this->cart);
        $this->promoCode = $promoCode;
        $this->address = $address;
    }

    public function execute()
    {
        return Auth::user()->orders()
            ->create(array_merge([
                'promo_code_id' => $this->promoCode->id ?? null,
                'address_id' => $this->address->id,
                'branch_id' => $this->cart->branch_id,
                'status' => Order::PENDING_ORDER_STATUS
            ],$this->calculations));
    }
}
