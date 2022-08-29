<?php

namespace App\Domains\OrderManagement\Models;

use App\Domains\AccountManagement\Models\Address;
use App\Domains\AccountManagement\Models\Branch;
use App\Domains\Authentication\Models\User;
use App\Domains\Transaction\Models\Transaction;
use Database\Factories\OrderFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $guarded = [];

    const PENDING_ORDER_STATUS = 'pending';
    const PREPARING_ORDER_STATUS = 'preparing';
    const REJECT_ORDER_STATUS = 'reject';

    const Order_STATUS =[
        'pending' => 'Pending',
        'preparing' => 'Preparing',
        'ready' => 'Ready',
        'reject', 'Rejected',
    ];

    const MAPPING_ORDER_STATUS = [
        1 => 'pending',
    ];

    protected static function newFactory(): OrderFactory
    {
        return OrderFactory::new();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function promoCode(): BelongsTo
    {
        return $this->belongsTo(PromoCode::class);
    }

    public function transaction(): HasOne
    {
        return $this->hasOne(Transaction::class);
    }

    public function cancelReason(): BelongsTo
    {
        return $this->belongsTo(OrderCancelReason::class,'cancel_reason_id');
    }
}
