<?php

namespace App\Domains\ApplicationManagement\Models;

use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\File;
use Spatie\Translatable\HasTranslations;

class Category extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasTranslations;

    public array $translatable = ['name'];

    protected $guarded=[];
    protected $appends = ['image'];

    protected static function newFactory(): CategoryFactory
    {
        return CategoryFactory::new();
    }

    public function parents(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_category_id')->whereNull('parent_category_id');
    }

    public function child(): HasMany
    {
        return $this->hasMany(self::class, 'parent_category_id');
    }

    public function scopeOfParentCategories(Builder $query): Builder
    {
        return $query->whereNull('parent_category_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('categories')
            ->acceptsFile(function (File $file) {
                return in_array($file->mimeType, [
                    'image/jpeg',
                    'image/png',
                ]);
            })->singleFile();
    }

    public function scopeOfShownOnHomePage(Builder $query): Builder
    {
        return $query->where('is_shown_on_home_page', true);
    }

    public function getImageAttribute(): ?string
    {
        return $this->getFirstMediaUrl('categories');
    }
}
