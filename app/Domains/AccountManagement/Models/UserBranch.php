<?php

namespace App\Domains\AccountManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\UserBranchFactory;
use App\Domains\Authentication\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserBranch extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory(): UserBranchFactory
    {
        return UserBranchFactory::new();
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
