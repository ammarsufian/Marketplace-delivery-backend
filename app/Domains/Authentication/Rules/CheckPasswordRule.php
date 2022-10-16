<?php

namespace App\Domains\Authentication\Rules;

use App\Domains\Interfaces\Rulable;
use Illuminate\Support\Facades\Hash;
use App\Domains\Authentication\Models\User;

class CheckPasswordRule implements Rulable
{
    protected string $password;
    protected string $currentPassword;

    public function __construct(string $password, User $user)
    {
        $this->password = $password;
        $this->currentPassword = $user->password;
    }

    public function run(): bool
    {
        return Hash::check($this->password, $this->currentPassword);
    }

    public function getMessage(): string
    {
        return 'Invalid password';
    }
}
