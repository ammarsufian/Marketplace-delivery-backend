<?php

namespace App\Nova\Actions;

use App\Domains\ApplicationManagement\Events\SendClientAppNotification;
use App\Domains\OrderManagement\Models\Order;
use App\Domains\OrderManagement\Models\OrderCancelReason;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;


class ChangeOrderStatusAction extends Action
{
    /**
     * Perform the action on the given models.
     *
     * @param \Laravel\Nova\Fields\ActionFields $fields
     * @param \Illuminate\Support\Collection $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $models->first()->update([
            'status' => $fields->status,
            'cancel_reason_id' => $fields->reason
        ]);

        event(new SendClientAppNotification($models->first(), 'COVA', 'order Status Changed'));

        return Action::message('Order ' . $fields->status . ' updated successfully.');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Select::make('Status', 'status')->options(Order::Order_STATUS)
                ->displayUsingLabels()->required(),

            Select::make('Cancel Reason', 'reason')->options(OrderCancelReason::query()->pluck('reason', 'id'))
                ->rules(['required_if:status,canceled']),

        ];
    }
}

// pending->processing->in-kitchen->pickup->in-route->completed->returned-to-shipper->delivered->canceled and rejected
