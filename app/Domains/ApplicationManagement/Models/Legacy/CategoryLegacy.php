<?php

namespace App\Domains\ApplicationManagement\Models\Legacy;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class CategoryLegacy extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $connection='legacy';
    protected $table='categories';

}
