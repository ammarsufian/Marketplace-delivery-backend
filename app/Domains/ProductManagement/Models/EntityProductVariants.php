<?php

namespace App\Domains\ProductManagement\Models;

use Database\Factories\EntityProductVariantFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class EntityProductVariants extends Pivot
{
    use HasFactory;

    protected $table = 'entity_product_variants';

    protected static function newFactory(): EntityProductVariantFactory
    {
        return EntityProductVariantFactory::new();
    }

    public function entityProduct(): BelongsTo
    {
        return $this->belongsTo(EntityProduct::class);
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo(Variant::class);
    }
}
