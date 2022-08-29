<?php

namespace App\Domains\ApplicationManagement\Models;

use Database\Factories\CountryFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Country extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = ['name'];

    public $guarded=[];

    const SAUDIA_COUNTRY_ID = 1;

    protected static function newFactory(): CountryFactory
    {
        return CountryFactory::new();
    }

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    public function scopeOfActiveCountry(Builder $query): Builder
    {
        return $query->where('is_active', 1);
    }
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = strtolower($value);
    }
}
