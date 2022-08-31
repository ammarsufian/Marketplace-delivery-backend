<?php

namespace App\Domains\AccountManagement\Actions;


use Illuminate\Support\Facades\Hash;
use App\Domains\Interfaces\Actionable;
use App\Domains\Authentication\Models\User;

class GetInvitationLinkAction implements Actionable
{

    protected User $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function execute()
    {
        $link = route('register', ['id' => $this->user->id]);
        return $link.'?key='.Hash::make($this->user->id);
    }
}
