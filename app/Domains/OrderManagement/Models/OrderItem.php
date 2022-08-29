<?php

namespace App\Domains\OrderManagement\Models;

use App\Domains\AccountManagement\Models\Branch;
use App\Domains\ProductManagement\Models\Variant;
use Database\Factories\OrderItemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';
    protected $guarded = [];

    protected static function newFactory(): OrderItemFactory
    {
        return OrderItemFactory::new();
    }

    public function buyable(): MorphTo
    {
        return $this->morphTo('buyable');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function variants(): BelongsToMany
    {
        return $this->belongsToMany(Variant::class, OrderItemVariant::class, 'order_item_id', 'variant_id')
            ->withPivot('price')
            ->as('variants');
    }

    public function getSubtotalAttribute(): float
    {
        return ($this->buyable->unit_price + $this->variants->sum('pivot.price')) * $this->quantity;
    }
}
