<?php

namespace App\Domains\ProductManagement\Models\Legacy;

use Illuminate\Database\Eloquent\Model;

class LegacyAdditionalItem extends Model
{
    protected $connection='legacy';

    protected $table = 'additional_items';
}
