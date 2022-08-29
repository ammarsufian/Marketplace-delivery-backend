<?php

namespace App\Domains\Transaction\Actions;

use App\Domains\Interfaces\Actionable;
use App\Domains\OrderManagement\Models\Order;
use App\Domains\Transaction\Models\CreditCard;
use App\Domains\Transaction\Models\PaymentMethod;
use App\Domains\Transaction\Models\Transaction;

class CreateOrderTransactionAction implements Actionable
{
    protected Order $order;
    protected PaymentMethod $paymentMethod;
    protected ?CreditCard $creditCard;

    public function __construct(Order $order,PaymentMethod $paymentMethod,?int $creditCardId)
    {
        $this->order = $order;
        $this->paymentMethod = $paymentMethod;
        $this->creditCard = CreditCard::ofUser()->find($creditCardId);
    }

    public function execute(): Transaction
    {
        return Transaction::create([
            'order_id' => $this->order->id,
            'payment_method_id' => $this->paymentMethod->id,
            'amount' => $this->order->total,
            'credit_card_id' => $this->creditCard->id ??null,
        ]);
    }
}
