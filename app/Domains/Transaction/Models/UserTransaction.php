<?php

namespace App\Domains\Transaction\Models;

use App\Domains\Authentication\Models\User;
use Database\Factories\UserTransactionFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class UserTransaction extends Model
{
    use HasFactory;

    protected $table = 'user_transactions';
    protected $guarded=['id'];

    protected static function newFactory():UserTransactionFactory
    {
        return UserTransactionFactory::new();
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeOfUser(Builder $query):Builder
    {
        return $query->where('user_id',Auth::user()->id);
    }
}
