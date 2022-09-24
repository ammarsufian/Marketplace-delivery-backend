<?php

namespace App\Domains\ApplicationManagement\Models;

use App\Domains\Authentication\Models\User;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\UserPackageFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPackage extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function newFactory(): UserPackageFactory
    {
        return UserPackageFactory::new();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
