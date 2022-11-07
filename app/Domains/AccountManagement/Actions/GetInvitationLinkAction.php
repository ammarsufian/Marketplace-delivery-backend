<?php

namespace App\Domains\AccountManagement\Actions;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Domains\Interfaces\Actionable;
use App\Domains\Authentication\Models\User;

class GetInvitationLinkAction implements Actionable
{

    protected User $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function execute()
    {
        $link = route('users.invitation', ['lang' => app()->getLocale(), 'referral_key' => $this->user->referral_key]);
        return $link;
    }
}
