<?php

namespace App\Domains\ApplicationManagement\Models\Legacy;

use Illuminate\Database\Eloquent\Model;

class LegacyMedia extends Model
{
    protected $connection='legacy';

    protected $table='media';
}
