<?php

namespace App\Domains\Authentication\Models;

use Database\Factories\AdminFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasApiTokens,HasFactory,HasRoles;

    protected $guarded=[];
    protected static function newFactory():AdminFactory
    {
        return AdminFactory::new();
    }
}
