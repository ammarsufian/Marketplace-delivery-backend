<?php

namespace App\Domains\ProductManagement\Models;

use Database\Factories\VariantFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Variant extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = ['name'];
    protected $guarded = [];
    protected $with = ['group'];

    protected static function newFactory(): VariantFactory
    {
        return VariantFactory::new();
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(GroupVariant::class, 'group_id');
    }
}
