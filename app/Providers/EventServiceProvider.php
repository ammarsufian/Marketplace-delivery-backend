<?php

namespace App\Providers;

use App\Observers\OrderObserver;
use App\Domains\OrderManagement\Models\Order;
use App\Domains\ApplicationManagement\Events\SendClientAppNotification;
use App\Domains\ApplicationManagement\Listeners\SendClientAppNotificationListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        SendClientAppNotification::class => [
            SendClientAppNotificationListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Order::observe(OrderObserver::class);
    }
}
