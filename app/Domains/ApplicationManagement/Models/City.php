<?php

namespace App\Domains\ApplicationManagement\Models;

use Illuminate\Support\Str;
use Database\Factories\CityFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = ['name'];

    protected $guarded = ['id'];

    protected static function newFactory(): CityFactory
    {
        return CityFactory::new();
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function scopeOfCountry(Builder $query, $country_id): Builder
    {
        return $query->where('country_id', $country_id);
    }
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = strtolower($value);
    }

}
