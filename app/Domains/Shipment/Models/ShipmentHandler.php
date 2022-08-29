<?php

namespace App\Domains\Shipment\Models;

use Database\Factories\ShipmentHandlerFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class ShipmentHandler extends Model
{
    use HasFactory;


    protected static function newFactory(): ShipmentHandlerFactory
    {
        return ShipmentHandlerFactory::new();
    }

    public function shipments(): HasMany
    {
        return $this->hasMany(Shipment::class);
    }

    public function scopeOfType(Builder $query, $type): Builder
    {
        return $query->where('type', $type);
    }

    public function scopeOfActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
