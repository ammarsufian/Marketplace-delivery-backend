<?php

namespace App\Domains\OrderManagement\Models;

use App\Domains\ProductManagement\Models\Variant;
use Database\Factories\CartItemVariantFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItemVariant extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['variant'];

    protected static function newFactory(): CartItemVariantFactory
    {
        return CartItemVariantFactory::new();
    }

    public function cartItem(): BelongsTo
    {
        return $this->belongsTo(CartItem::class);
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo(Variant::class);
    }
}
