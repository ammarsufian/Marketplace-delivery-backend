<?php

namespace App\Domains\Shipment\ShipmentHandlers\Cafe\Sender;

use App\Domains\AccountManagement\Models\Address;
use App\Domains\AccountManagement\Models\Branch;
use App\Domains\Interfaces\Actionable;
use App\Domains\OrderManagement\Models\Order;
use App\Domains\OrderManagement\Models\OrderItem;
use App\Domains\Shipment\Contracts\ShipmentGateway;

class StoreSenderOrderAction extends ShipmentGateway implements Actionable
{
    protected Order $order;
    protected Branch $branch;
    protected Address $address;

    public function __construct(Order $order, Branch $branch)
    {
        parent::__construct();
        $this->order = $order;
        $this->branch = $branch;
        $this->address = $this->order->address;
    }

    public function execute()
    {
        return $this->send();
    }

    public function getUrl(): string
    {
        return config('shipmentHandler.sender.base_url') . config('shipmentHandler.sender.endpoints.place_order');
    }

    public function getParams(): array
    {
        return [
            "provider_id" => config('shipmentHandler.sender.provider_id'),
            "payment_method" => 'cod',
            "api_key" => config('shipmentHandler.sender.api_key'),
            "total" => $this->order->items->sum('total'),
            'client' => $this->getUserData(),
            'products' => $this->getProductsData(),
            "remaining" => 20,
            "provider_lat" => $this->branch->latitude,
            "provider_lng" => $this->branch->longitude
        ];
    }

    protected function getUserData(): array
    {
        $user = $this->order->user;
        return [
            'name' => $user->name,
            'mobile' => 540004718,
            'lat' => $this->address->latitude,
            'long' => $this->address->longitude,
            'address' => $this->address->details ?? "UNKNOWN",
        ];
    }

    protected function getProductsData(): array
    {
        return $this->order->items->map(function (OrderItem $orderItem) {
            $buyable = $orderItem->buyable;
            return [
                'product_name' => $buyable->product->name,
                'peice_price' => $buyable->unit_price,
                'qty' => $orderItem->quantity,
            ];
        })->toArray();
    }

    public function getMethod(): string
    {
        return 'POST';
    }
}
