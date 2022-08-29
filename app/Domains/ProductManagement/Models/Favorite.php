<?php

namespace App\Domains\ProductManagement\Models;

use App\Domains\Authentication\Models\User;
use Database\Factories\FavoriteFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favorite extends Model
{
    use HasFactory;

    protected $table = 'favorites';

    protected $guarded = ['id'];

    protected $with = ['entityProduct'];

    protected static function newFactory(): FavoriteFactory
    {
        return FavoriteFactory::new();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function entityProduct(): BelongsTo
    {
        return $this->belongsTo(EntityProduct::class);
    }
}
