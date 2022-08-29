<?php

namespace App\Domains\AccountManagement\Models;

use App\Domains\ApplicationManagement\Models\Country;
use Database\Factories\BrandFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\File;
use Spatie\Translatable\HasTranslations;

class Brand extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasTranslations;

    protected $with = ['branches'];

    protected $appends = ['logo'];

    public array $translatable = ['name'];

    const ACTIVE_STATUS_BRAND = 1;

    protected $guarded = [];

    protected static function newFactory(): BrandFactory
    {
        return BrandFactory::new();
    }

    public function branches(): HasMany
    {
        return $this->hasMany(Branch::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')
            ->acceptsFile(function (File $file) {
                return in_array($file->mimeType, [
                    'image/jpeg',
                    'image/png',
                ]);
            })->singleFile();
    }

    public function scopeOfActive(Builder $query, $status): Builder
    {
        return $query->where('status', $status);
    }

    public function getLogoAttribute(): ?string
    {
        return $this->getFirstMediaUrl('logo');
    }
}
