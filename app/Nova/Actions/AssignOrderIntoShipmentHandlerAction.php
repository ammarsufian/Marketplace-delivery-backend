<?php

namespace App\Nova\Actions;

use App\Domains\Shipment\Actions\CreateShipmentAction;
use App\Domains\Shipment\Models\ShipmentHandler;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;

class AssignOrderIntoShipmentHandlerAction extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param \Laravel\Nova\Fields\ActionFields $fields
     * @param \Illuminate\Support\Collection $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $data = (new CreateShipmentAction($models->first(), ShipmentHandler::find($fields['shipment_handler'])))->execute();

        dd($data);
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Select::make('Shipment Handler', 'shipment_handler')->options(
                ShipmentHandler::ofActive()->pluck('name', 'id')
            )
        ];
    }
}
