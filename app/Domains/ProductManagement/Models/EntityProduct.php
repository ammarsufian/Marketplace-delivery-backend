<?php

namespace App\Domains\ProductManagement\Models;

use App\Domains\AccountManagement\Models\Branch;
use Database\Factories\EntityProductFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EntityProduct extends Model
{
    use HasFactory;

    protected $guarded = [];
    const ENTITY_PRODUCT_STATUS = [
        'active',
        'in-active'
    ];
    const ACTIVE_STATUS = 'active';

    protected $with = ['product']; //Eager Loading

    protected $appends = ['name', 'image']; //inject this keys in-side entityProduct object

    protected static function newFactory(): EntityProductFactory
    {
        return EntityProductFactory::new();
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function variants(): BelongsToMany
    {
        return $this->belongsToMany(Variant::class, EntityProductVariants::class, 'entity_product_id', 'variant_id')
            ->withPivot('price');
    }

    public function additional(): BelongsToMany
    {
        return $this->belongsToMany(AdditionalItem::class, EntityProductAdditionalItem::class, 'entity_product_id', 'additional_item_id')
            ->withPivot('price');
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    public function scopeOfStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }

    public function scopeOfBranch(Builder $query, int $branchId): Builder
    {
        return $query->where('branch_id', $branchId);
    }

    public function getNameAttribute()
    {
        return $this->product->name;
    }

    public function getImageAttribute()
    {
        return $this->product->image;
    }

}
