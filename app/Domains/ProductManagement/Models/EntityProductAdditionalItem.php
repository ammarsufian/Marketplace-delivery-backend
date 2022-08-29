<?php

namespace App\Domains\ProductManagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class EntityProductAdditionalItem extends Pivot
{
    use HasFactory;

    protected $table = 'entity_product_additional_items';

    public function entityProduct(): BelongsTo
    {
        return $this->belongsTo(EntityProduct::class);
    }

    public function additionalItem(): BelongsTo
    {
        return $this->belongsTo(AdditionalItem::class);
    }
}
