<?php

namespace App\Domains\Authentication\Rules;

use App\Domains\Authentication\Models\User;
use App\Domains\Interfaces\Rulable;

class CheckGuestRule implements Rulable
{
    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function run(): bool
    {
        return !$this->user->hasRole('guest');
    }

    public function getMessage(): string
    {
        return 'This User Must be have permission';
    }

    public function getCode(): int
    {
        return 401;
    }

}
