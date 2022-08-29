<?php

namespace App\Domains\OrderManagement\Models;

use App\Domains\ProductManagement\Models\Variant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItemVariant extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['variant'];

    public function orderItem(): BelongsTo
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo(Variant::class);
    }
}
