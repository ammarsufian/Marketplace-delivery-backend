<?php

namespace App\Domains\AccountManagement\Models;

use Database\Factories\NewJoinerFactory;
use Illuminate\Database\Eloquent\Model;
use App\Domains\ApplicationManagement\Models\City;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class NewJoiner extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

   protected static function  newFactory(): NewJoinerFactory
    {
        return NewJoinerFactory::new();
    }

    function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}