<?php

namespace App\Domains\Authentication\Models;

use App\Domains\AccountManagement\Models\Address;
use App\Domains\AccountManagement\Models\Branch;
use App\Domains\AccountManagement\Models\UserBranch;
use App\Domains\OrderManagement\Models\Cart;
use App\Domains\OrderManagement\Models\Order;
use App\Domains\ProductManagement\Models\Favorite;
use App\Domains\Transaction\Models\CreditCard;
use App\Domains\Transaction\Models\UserTransaction;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use function App\Helpers\mobile;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    const PROVIDER_ROLE = 'provider';
    const APPLICATION_ROLE = 'application';

    protected $guarded = [];

    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(UserTransaction::class);
    }

    public function creditCards(): HasMany
    {
        return $this->hasMany(CreditCard::class);
    }

    public function branches(): BelongsToMany
    {
        return $this->belongsToMany(Branch::class, UserBranch::class, 'user_id', 'branch_id');
    }

    public function setMobileNumberAttribute($value): void
    {
        $this->attributes['mobile_number'] = mobile($value);
    }

    public function scopeOfReferralKey(Builder $query, $referral_key): Builder
    {
        return $query->where('referral_key', $referral_key);
    }
}
