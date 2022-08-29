<?php

namespace App\Domains\AccountManagement\Models\Legacy;

use Illuminate\Database\Eloquent\Model;

class UserLegacy extends Model
{
    protected $connection = 'legacy';

    protected $table = 'users';
}
