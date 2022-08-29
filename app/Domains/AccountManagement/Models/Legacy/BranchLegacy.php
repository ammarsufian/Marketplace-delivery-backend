<?php

namespace App\Domains\AccountManagement\Models\Legacy;

use Illuminate\Database\Eloquent\Model;

class BranchLegacy extends Model
{
    protected $connection = 'legacy';

    protected $table = 'branches';
}
