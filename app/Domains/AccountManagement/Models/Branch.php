<?php

namespace App\Domains\AccountManagement\Models;

use App\Domains\ApplicationManagement\Models\Category;
use App\Domains\Authentication\Models\User;
use App\Domains\OrderManagement\Models\Order;
use App\Domains\ProductManagement\Models\EntityProduct;
use App\Domains\Shipment\Facade\ShipmentFacade;
use Carbon\Carbon;
use Database\Factories\BranchFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Branch extends Model
{
    use HasFactory;

    const ACTIVE_STATUS_BRANCH = 1;
    const BRANCH_TYPES = ['cafe', 'roaster'];

    protected $guarded = [];
    protected $casts = [
        'schedule' => 'array',
        'contact_us' => 'array',
    ];

    protected $appends = ['today_schedule'];

    protected static function newFactory(): BranchFactory
    {
        return BranchFactory::new();
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'branch_categories', 'branch_id', 'category_id')->withTimestamps();
    }

    public function owners(): BelongsToMany
    {
        return $this->belongsToMany(User::class, UserBranch::class, 'branch_id', 'user_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function entityProducts(): HasMany
    {
        return $this->hasMany(EntityProduct::class);
    }

    public function scopeOfBrand(Builder $query, $brand_id): Builder
    {
        return $query->where('brand_id', $brand_id);
    }

    public function getTodayScheduleAttribute(): array
    {
        $schedule = $this->schedule[strtolower(Carbon::now()->format('l'))];
        $times = explode('-', $schedule[0]);

        return [
            'open_datetime' => Carbon::createFromFormat("H:i", $times[0]),
            'close_datetime' => Carbon::createFromFormat("H:i", $times[1]),
        ];
    }

    public function getDeliveryDataAttribute()
    {
        return ShipmentFacade::getDistanceByGoogle([$this->latitude, $this->longitude]);
    }

}
