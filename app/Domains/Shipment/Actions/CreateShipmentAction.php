<?php

namespace App\Domains\Shipment\Actions;

use App\Domains\AccountManagement\Models\Branch;
use App\Domains\Interfaces\Actionable;
use App\Domains\OrderManagement\Models\Order;
use App\Domains\Shipment\Models\ShipmentHandler;
use App\Domains\Shipment\ShipmentHandlers\Cafe\Sender\StoreSenderOrderAction;

class CreateShipmentAction implements Actionable
{
    protected Order $order;
    protected Branch $branch;
    protected ShipmentHandler $shipmentHandler;
    protected array $shipmentHandlers;

    public function __construct(Order $order, ?ShipmentHandler $shipmentHandler = null)
    {
        $this->order = $order;
        $this->branch = $this->order->branch;
        $this->shipmentHandler = ShipmentHandler::where('name', 'sender')->first();
        $this->shipmentHandlers = [
            'sender' => StoreSenderOrderAction::class
        ];
    }

    public function execute()
    {
        return app(data_get($this->shipmentHandlers, $this->shipmentHandler->name), [
            'order' => $this->order,
            'branch' => $this->branch
        ])->execute();
    }
}
