<?php

namespace App\Domains\AccountManagement\Actions;

use App\Domains\AccountManagement\Http\Requests\InvitedUserRequest;
use Illuminate\Support\Facades\Hash;
use App\Domains\Interfaces\Actionable;
use App\Domains\Authentication\Models\User;
use Illuminate\Http\Request;

class CreateInvitedUserAction implements Actionable
{
    protected Request $request;
    protected User $senderUser;

    public function __construct(InvitedUserRequest $request)
    {
        $this->request = $request;
        $this->senderUser = User::ofReferralKey($request->get('referral_key'))->first();
    }

    public function execute(): User
    {
        $user = User::create([
            'name' => $this->request->get('firstName') . ' ' . $this->request->get('lastName'),
            'email' => $this->request->get('email'),
            'mobile_number' => $this->request->get('mobileNumber'),
            'referral_key' => mt_rand(123456, 999999),
            'invitation_sender_id' => $this->senderUser->id,
        ]);
        //TODO:: make pending point to users
        return $user;
    }
}
