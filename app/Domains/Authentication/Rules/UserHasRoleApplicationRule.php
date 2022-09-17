<?php

namespace App\Domains\Authentication\Rules;

use App\Domains\Interfaces\Rulable;
use Illuminate\Support\Facades\Auth;
use App\Domains\Authentication\Models\User;

class UserHasRoleApplicationRule implements Rulable
{

    public function run(): bool
    {
        return (bool) Auth::user()->hasRole(User::APPLICATION_ROLE);
    }

    public function getMessage(): string
    {
        return 'User Account is not application type';
    }

}
