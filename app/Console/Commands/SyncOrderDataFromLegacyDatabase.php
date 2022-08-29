<?php

namespace App\Console\Commands;

use App\Domains\OrderManagement\Actions\PromoCode\CashBackAction;
use App\Domains\OrderManagement\Actions\PromoCode\DeliveryPercentageDiscountAction;
use App\Domains\OrderManagement\Actions\PromoCode\DeliveryPriceDiscountAction;
use App\Domains\OrderManagement\Actions\PromoCode\DiscountBrandAction;
use App\Domains\OrderManagement\Actions\PromoCode\DiscountPackageAction;
use App\Domains\OrderManagement\Models\Legacy\LegacyPromoCode;
use App\Domains\OrderManagement\Models\Legacy\LegacyTransaction;
use App\Domains\OrderManagement\Models\Legacy\OrderItemLegacy;
use App\Domains\OrderManagement\Models\Legacy\OrderLegacy;
use App\Domains\OrderManagement\Models\Order;
use App\Domains\OrderManagement\Models\OrderItem;
use App\Domains\OrderManagement\Models\PromoCode;
use App\Domains\ProductManagement\Models\EntityProduct;
use App\Domains\Transaction\Models\PaymentMethod;
use App\Domains\Transaction\Models\Transaction;
use Illuminate\Console\Command;

class SyncOrderDataFromLegacyDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:orders';
    protected array $promoCodeType;
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Promocode,Orders,Transactions and shipments from old database into new database';

    /**
     * Create a new command instance.
     *
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->models = [
            'Order' => Order::class,
            'PromoCode' => PromoCode::class,
            'Transaction' => Transaction::class,
            'OrderItem' => OrderItem::class
        ];
        $this->promoCodeType = [
            'percentage_discount' => DeliveryPercentageDiscountAction::class,
            'Discount_on_total' => DeliveryPriceDiscountAction::class,
            'package' => DiscountPackageAction::class,
            'brand' => DiscountBrandAction::class,
            'cash_back' => CashBackAction::class,
        ];
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ini_set('memory_limit', '-1');
        $selectedModel = $this->choice('Please select tables to sync it ', $this->models);

        if ($selectedModel == 'Order') {
            return $this->syncOrderData();
        } elseif ($selectedModel == 'PromoCode') {
            return $this->syncPromoCode();
        } elseif ($selectedModel == 'Transaction') {
            return $this->syncTransactionData();
        } elseif ($selectedModel == 'OrderItem') {
            return $this->syncOrderItems();
        }

        return 'Done';
    }

    public function syncPromoCode()
    {
        LegacyPromoCode::chunk(100, function ($promoCodes) {
            $promoCodes->each(function (LegacyPromoCode $legacyPromoCode) {
                PromoCode::create([
                    'id' => $legacyPromoCode->id,
                    'promo_code' => $legacyPromoCode->code,
                    'start_datetime' => $legacyPromoCode->work_at,
                    'end_datetime' => $legacyPromoCode->expired_at,
                    'counter' => $legacyPromoCode->counter,
                    'is_active' => false,
                    'type' => $this->promoCodeType[$legacyPromoCode->type],
                    'created_at' => $legacyPromoCode->created_at,
                    'updated_at' => $legacyPromoCode->updated_at,
                    'value' => $legacyPromoCode->discount
                ]);
            });
        });

        echo 'Done';
        return 0;
    }

    public function syncOrderData()
    {
        OrderLegacy::chunk(100, function ($orders) {
            $orders->each(function ($order) {
                if ($order->user_id == 1820)
                    return [];

                Order::updateOrCreate(['id' => $order->id], [
                    'id' => $order->id,
                    'user_id' => $order->user_id,
                    'address_id' => $order->address_id,
                    'status' => $order->status ?? 'delivered',
                    'promo_code_id' => $order->promo_code_id,
                    'branch_id' => $order->branch_id,
                    'created_at' => $order->created_at,
                    'updated_at' => $order->updated_at,
                    'total' => 0,
                    'subtotal' => 0,
                    'delivery' => 0,
                    'vat' => 0,
                    'discount' => 0
                ]);
            });
        });
        return 'Done';
    }

    public function syncTransactionData()
    {
        $paymentMethod = [
            'POINTS' => 'points',
            'CASH' => 'cash-on-delivery',
            'ONLINE' => 'online',
	   'APPLE'=>'online',
        ];
        LegacyTransaction::chunk(1000, function ($transactions) use ($paymentMethod) {
            $transactions->each(function ($transaction) use ($paymentMethod) {
		 if ($transaction->order_id == 907 || $transaction->order_id == 938)
	                    return [];
                Transaction::updateOrCreate(['id' => $transaction->id], [
                    'id' => $transaction->id,
                    'payment_id' => $transaction->payment_id,
                    'amount' => $transaction->amount,
                    'order_id' => $transaction->order_id,
                    'status' => 'successful',
                    'payment_method_id' => PaymentMethod::where('slug', $paymentMethod[$transaction->payment_method])->first()->id,
                ]);
            });
        });
        return 'DONE';
    }

    public function syncOrderItems()
    {
        OrderItemLegacy::chunk(1000, function ($items) {
            $items->each(function ($item) {
                if ($item->order_id == 907 || $item->order_id == 938)
                    return [];
                if ($item->buy_type == 'Product') {
                    OrderItem::updateOrCreate(['id' => $item->id], [
                        'id' => $item->id,
                        'buyable_id' => $item->buy_id,
                        'buyable_type' => EntityProduct::class,
                        'order_id' => $item->order_id,
                        'created_at' => $item->created_at,
                        'quantity' => $item->quantity,
                        'unit_price' => $item->price,
                        'total' => $item->quantity * $item->price,
                        'discount' => 0,
                        'vat' => 0,
                        'branch_id' => 3
                    ]);
                }
                return [];
            });
        });
        return 'DONE';
    }
}
