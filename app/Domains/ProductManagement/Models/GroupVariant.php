<?php

namespace App\Domains\ProductManagement\Models;

use Database\Factories\GroupVariantFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupVariant extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function newFactory(): GroupVariantFactory
    {
        return GroupVariantFactory::new();
    }
}
