<?php

namespace App\Domains\Shipment\Facade;

use App\Domains\Shipment\Services\ShipmentService;
use Illuminate\Support\Facades\Facade;

class ShipmentFacade extends Facade
{
    protected static function getFacadeAccessor() :string
    {
        return ShipmentService::class;
    }
}

