<?php

namespace App\Domains\Shipment\Models;

use App\Domains\OrderManagement\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shipment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function shipmentHandler(): BelongsTo
    {
        return $this->belongsTo(ShipmentHandler::class);
    }
}
