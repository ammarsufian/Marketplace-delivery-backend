<?php

namespace App\Domains\AccountManagement\Models;

use App\Domains\ApplicationManagement\Models\City;
use App\Domains\Authentication\Models\User;
use Database\Factories\AddressFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    const ADDRESS_TYPE = ['home', 'work'];

    protected $guarded = [];

    protected static function newFactory(): AddressFactory
    {
        return AddressFactory::new();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

}
