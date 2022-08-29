<?php

namespace App\Domains\AccountManagement\Models\Legacy;

use App\Domains\Authentication\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AddressLegacy extends Model
{
    protected $connection = 'legacy';

    protected $table = 'addresses';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
