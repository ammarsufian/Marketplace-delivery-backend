<?php

namespace App\Domains\OrderManagement\Models\Legacy;

use Illuminate\Database\Eloquent\Model;

class LegacyTransaction extends Model
{
    protected $connection = 'legacy';

    protected $table = 'transactions';
}
