<?php

namespace App\Domains\OrderManagement\Models\Legacy;

use Illuminate\Database\Eloquent\Model;

class LegacyPromoCode extends Model
{
    protected $connection = 'legacy';

    protected $table = 'promo_codes';
}
