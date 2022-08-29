<?php

namespace App\Domains\OrderManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Database\Factories\OrderCancelReasonFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderCancelReason extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'status',
        'reason',
    ];
    
    public array $translatable = ['reason'];
    

    protected static function newFactory(): OrderCancelReasonFactory
    {
        return OrderCancelReasonFactory::new();
    }
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = strtolower($value);
    }
}
