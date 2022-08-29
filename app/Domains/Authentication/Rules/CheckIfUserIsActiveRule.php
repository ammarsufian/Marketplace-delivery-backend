<?php

namespace App\Domains\Authentication\Rules;

use App\Domains\Interfaces\Rulable;
use Illuminate\Support\Facades\Auth;

class CheckIfUserIsActiveRule implements Rulable
{

    public function run(): bool
    {
        return (bool) Auth::user()->is_active;
    }

    public function getMessage(): string
    {
        return 'User Account is not active';
    }
}
