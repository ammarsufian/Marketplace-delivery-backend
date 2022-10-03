<?php

namespace App\Domains\Authentication\Rules;

use App\Domains\Interfaces\Rulable;
use Illuminate\Support\Facades\Auth;

class CheckIfUserIsActiveRule implements Rulable
{
    protected $user;
    public function __construct($user=null)
    {
        $this->user = $user;
    }
    public function run(): bool
    {
        if($this->user == null)
            $this->user = Auth::user();

        return (bool) $this->user->is_active;
    }

    public function getMessage(): string
    {
        return 'User Account is not active';
    }
}
