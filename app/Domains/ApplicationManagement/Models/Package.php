<?php

namespace App\Domains\ApplicationManagement\Models;

use Database\Factories\PackageFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory, HasTranslations;

    protected $guarded = [];
    public array $translatable = ['name', 'description'];

    public static function newFactory(): PackageFactory
    {
        return PackageFactory::new();
    }
}

