<?php

namespace App\Domains\OrderManagement\Models\Legacy;

use Illuminate\Database\Eloquent\Model;

class OrderLegacy extends Model
{
    protected $connection = 'legacy';

    protected $table = 'orders';
}
