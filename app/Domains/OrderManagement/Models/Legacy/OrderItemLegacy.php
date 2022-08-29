<?php

namespace App\Domains\OrderManagement\Models\Legacy;

use Illuminate\Database\Eloquent\Model;

class OrderItemLegacy extends Model
{
    protected $connection = 'legacy';

    protected $table = 'order_items';
}
