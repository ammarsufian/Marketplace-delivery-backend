<?php

namespace App\Domains\ProductManagement\Models;

use Database\Factories\AdditionalItemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class AdditionalItem extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = ['name'];

    protected static function newFactory(): AdditionalItemFactory
    {
        return AdditionalItemFactory::new();
    }
}
