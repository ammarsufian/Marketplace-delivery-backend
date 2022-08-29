<?php

namespace App\Domains\AccountManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\ContactUsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactUs extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    protected static function  newFactory(): ContactUsFactory
    {
        return ContactUsFactory::new();
    }

}
