<?php

namespace App\Domains\ProductManagement\Models\Legacy;

use App\Domains\AccountManagement\Models\Legacy\BrandLegacy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LegacyEntityProduct extends Model
{
    protected $connection = 'legacy';

    protected $table = 'products';

    public function brand(): BelongsTo
    {
        return $this->belongsTo(BrandLegacy::class, 'brand_id');
    }

    public function variants()
    {
        return $this->belongsToMany(LegacyVariants::class, 'products_product_variants', 'product_id', 'variant_id')->withPivot('price');
    }

    public function additional_items()
    {
        return $this->belongsToMany(LegacyAdditionalItem::class, 'additional_items_product', 'product_id', 'additional_item_id')->withPivot('price');
    }
}
