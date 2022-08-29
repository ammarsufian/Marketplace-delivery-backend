<?php

namespace App\Domains\ProductManagement\Models\Legacy;

use Illuminate\Database\Eloquent\Model;

class LegacyProduct extends Model
{
    protected $connection='legacy';

    protected $table='product_models';
}
