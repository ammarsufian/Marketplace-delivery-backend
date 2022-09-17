<?php

namespace App\Domains\ApplicationManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\UserPackageFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserPackage extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function newFactory(): UserPackageFactory
    {
        return UserPackageFactory::new();
    }

}
