<?php

namespace App\Domains\Transaction\Models;


use Database\Factories\CreditCardCompanyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\File;
use Spatie\Translatable\HasTranslations;

class CreditCardCompany extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia;

    public array $translatable = ['name'];
    protected $guarded = ['id'];
    protected $appends = ['image'];

    protected static function newFactory(): CreditCardCompanyFactory
    {
        return CreditCardCompanyFactory::new();
    }

    public function creditCards(): HasMany
    {
        return $this->hasMany(CreditCard::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('creditCardCompanies')
            ->acceptsFile(function (File $file) {
                return in_array($file->mimeType, [
                    'image/jpeg',
                    'image/png',
                    'image/jpg',
                ]);
            })->singleFile();
    }

    public function getImageAttribute(): ?string
    {
        $media = $this->getFirstMedia('creditCardCompanies');
        return isset($media) ? $media->getFullUrl() : null;
    }

    public function scopeOfSlug(Builder $query, string $slug): Builder
    {
        return $query->where('slug', $slug);
    }
}
