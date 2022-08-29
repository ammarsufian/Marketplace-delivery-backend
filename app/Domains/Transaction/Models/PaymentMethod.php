<?php

namespace App\Domains\Transaction\Models;

use Database\Factories\PaymentMethodFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class PaymentMethod extends Model
{
    use HasFactory,HasTranslations;

    public array $translatable = ['name'];

    protected $guarded =['id'];

    protected static function newFactory():PaymentMethodFactory
    {
        return PaymentMethodFactory::new();
    }

    public function transactions():HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function scopeOfActive(Builder $query):Builder
    {
        return $query->where('is_active',true);
    }
}
