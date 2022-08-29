<?php

namespace App\Domains\OrderManagement\Models;

use App\Domains\AccountManagement\Models\Brand;
use App\Domains\OrderManagement\Actions\PromoCode\CashBackAction;
use App\Domains\OrderManagement\Actions\PromoCode\DeliveryPercentageDiscountAction;
use App\Domains\OrderManagement\Actions\PromoCode\DeliveryPriceDiscountAction;
use App\Domains\OrderManagement\Actions\PromoCode\DiscountBrandAction;
use Database\Factories\PromoCodeFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PromoCode extends Model
{
    use HasFactory;

    // we miss the total discount,package discount
    const PROMO_CODE_TYPE = [
        DeliveryPercentageDiscountAction::class => 'Percentage From Delivery Price',
        DeliveryPriceDiscountAction::class => 'Discount On Delivery Price',
        CashBackAction::class => 'Cash Back Discount',
        DiscountBrandAction::class => 'Discount on Brand',
    ];

    protected $guarded = [];

    protected $casts = [
        'start_datetime' => 'datetime',
        'end_datetime' => 'datetime',
    ];

    protected static function newFactory(): PromoCodeFactory
    {
        return PromoCodeFactory::new();
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function scopeOfPromoCode(Builder $query, string $promoCode): Builder
    {
        return $query->where('promo_code', $promoCode);
    }
}
