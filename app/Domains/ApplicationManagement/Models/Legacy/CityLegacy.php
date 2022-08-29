<?php

namespace App\Domains\ApplicationManagement\Models\Legacy;

use Illuminate\Database\Eloquent\Model;

class CityLegacy extends Model
{
    protected $connection = 'legacy';

    protected $table = 'cities';
}
