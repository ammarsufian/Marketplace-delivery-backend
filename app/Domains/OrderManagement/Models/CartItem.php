<?php

namespace App\Domains\OrderManagement\Models;

use App\Domains\AccountManagement\Models\Branch;
use App\Domains\ProductManagement\Models\EntityProduct;
use App\Domains\ProductManagement\Models\Variant;
use Database\Factories\CartItemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class CartItem extends Model
{
    use HasFactory;

    protected $table = 'cart_items';


    const BUYABLE_MODELS = [
        'EntityProduct' => EntityProduct::class,
    ];

    protected $guarded = ['id'];

    protected static function newFactory(): CartItemFactory
    {
        return CartItemFactory::new();
    }

    public function buyable(): MorphTo
    {
        return $this->morphTo('buyable');
    }

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function variants(): BelongsToMany
    {
        return $this->belongsToMany(Variant::class, CartItemVariant::class, 'cart_item_id', 'variant_id')
            ->withPivot('price');
    }

    public function getSubtotalAttribute(): float
    {
        return ($this->buyable->unit_price + $this->variants->sum('pivot.price')) * $this->quantity;
    }
}
