<?php

namespace App\Domains\AccountManagement\Actions;


use App\Domains\Interfaces\Actionable;
use App\Domains\Authentication\Models\User;

class CheckInvitationLinkAction implements Actionable
{
    protected string $referral_key;

    public function __construct(string $referral_key)
    {
        $this->referral_key = $referral_key;
    }

    public function execute(): bool
    {
        return User::ofReferralKey($this->referral_key)->exists();
    }

}
