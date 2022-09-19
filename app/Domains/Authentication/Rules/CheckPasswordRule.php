<?php

namespace App\Domains\Authentication\Rules;

use App\Domains\Interfaces\Rulable;
use Illuminate\Support\Facades\Hash;
use App\Domains\Authentication\Models\User;

class CheckPasswordRule implements Rulable
{
    protected string $password;
    protected string $hashedPassword;
    public function __construct(string $password, User $user)
    {
        $this->password = $password;
        $this->hashedPassword = $user->password;
    }

    public function run(): bool
    {
        return Hash::check($this->password, $this->hashedPassword);
    }

    public function getMessage(): string
    {
        return 'Invalid password';
    }
}
