<?php

namespace App\Domains\Transaction\Models;

use App\Domains\Authentication\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\CreditCardFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreditCard extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $with = ['company'];

    protected $appends = ['last_digits'];

    protected static function newFactory(): CreditCardFactory
    {
        return CreditCardFactory::new();
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(CreditCardCompany::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getLastDigitsAttribute()
    {
        return substr($this->card_number, -4);
    }

    public function setCompanyIdAttribute($cardNumber)
    {
        if (Str::startsWith($cardNumber, '4'))
            $this->attributes['company_id'] = CreditCardCompany::ofSlug('visa')->first()->id;
        else
            $this->attributes['company_id'] = CreditCardCompany::ofSlug('master-card')->first()->id;
    }

    public function setExpirationDateAttribute($value)
    {
        if ($value instanceof Carbon)
            $this->attributes['expiration_date'] = $value;
        else
            $this->attributes['expiration_date'] = Carbon::createFromFormat('d/m/y', '1/' . $value);
    }

    public function scopeOfUser(Builder $query): Builder
    {
        return $query->where('user_id', Auth::user()->id);
    }
}
