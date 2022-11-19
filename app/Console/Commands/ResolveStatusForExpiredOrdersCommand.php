<?php

namespace App\Console\Commands;

use App\Domains\ApplicationManagement\Events\SendClientAppNotification;
use App\Domains\OrderManagement\Models\Order;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Laravel\Sanctum\PersonalAccessToken;

class ResolveStatusForExpiredOrdersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'resolve:pending-orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resolve Pending Orders After 10 minutes ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $orders = Order::query()
            ->where('status', Order::PENDING_ORDER_STATUS)
            ->where('created_at', '>=', Carbon::now()->subMinutes(10))
            ->update(['status' => Order::REJECT_ORDER_STATUS]);

        //TODO:add send user notification after reject his orders
        if ($orders) {
            $listeners = PersonalAccessToken::whereIn('tokenable_id', $orders->pluck('user_id')->toArray())
                ->whereNotNull('fcm_token')->pluck('fcm_token')->toArray();

            if ($listeners)
                event(new SendClientAppNotification($orders->first(), 'Cova', 'Your Order has been rejected', $listeners));
        }
        return 0;
    }
}
