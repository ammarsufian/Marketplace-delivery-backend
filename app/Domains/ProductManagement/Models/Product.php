<?php

namespace App\Domains\ProductManagement\Models;

use App\Domains\ApplicationManagement\Models\Category;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\File;
use Spatie\Translatable\HasTranslations;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasTranslations;

    public array $translatable = ['name', 'description'];

    protected $guarded=[];

    protected $appends = ['image'];

    protected static function newFactory(): ProductFactory
    {
        return ProductFactory::new();
    }

    public function entityProducts(): HasMany
    {
        return $this->hasMany(EntityProduct::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('product')
            ->acceptsFile(function (File $file) {
                return in_array($file->mimeType, [
                    'image/jpeg',
                    'image/png',
                ]);
            })->singleFile();
    }

    public function getImageAttribute(): ?string
    {
        return $this->getFirstMediaUrl('product');
    }
}
