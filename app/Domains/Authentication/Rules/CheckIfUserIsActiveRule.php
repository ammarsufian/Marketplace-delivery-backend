<?php

namespace App\Domains\Authentication\Rules;

use App\Domains\Authentication\Models\User;
use App\Domains\Interfaces\Rulable;
use Illuminate\Support\Facades\Auth;

class CheckIfUserIsActiveRule implements Rulable
{
    protected ?User $user;

    public function __construct(?User $user = null)
    {
        $this->user = $user ?? Auth::user();
    }

    public function run(): bool
    {
        return (bool)$this->user->is_active;
    }

    public function getMessage(): string
    {
        return 'User Account is not active';
    }

    public function getCode(): int
    {
        return 401;
    }
}
