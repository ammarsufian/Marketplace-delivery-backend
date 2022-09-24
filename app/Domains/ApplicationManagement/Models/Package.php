<?php

namespace App\Domains\ApplicationManagement\Models;

use App\Domains\AccountManagement\Models\Branch;
use Database\Factories\PackageFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function scopeOfActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}

