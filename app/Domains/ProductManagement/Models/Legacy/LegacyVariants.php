<?php

namespace App\Domains\ProductManagement\Models\Legacy;

use Illuminate\Database\Eloquent\Model;

class LegacyVariants extends Model
{
    protected $connection='legacy';

    protected $table = 'product_variants';
}
