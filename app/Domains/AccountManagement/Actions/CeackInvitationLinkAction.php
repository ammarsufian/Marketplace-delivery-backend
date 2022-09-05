<?php

namespace App\Domains\AccountManagement\Actions;

use Illuminate\Http\Request;

use App\Domains\Interfaces\Actionable;
use App\Domains\Authentication\Models\User;

class CeackInvitationLinkAction implements Actionable
{
    protected $referral_key;

    public function __construct($referral_key)
    {
        $this->referral_key = $referral_key;
    }

    public function execute()
    {
        $result= User::where('referral_key', $this->referral_key)->first();
        return $result ? true : false;
    }
    
}
