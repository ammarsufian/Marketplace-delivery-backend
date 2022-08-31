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

    public function __construct(InvitedUserRequest $request)
    {
        $this->request = $request;
    }

    public function execute()
    {

        $user = User::create([
            'name' => $this->request->get('firstName') . ' ' . $this->request->get('lastName'),
            'email' => $this->request->email,
            'mobile_number'=>$this->request->mobileNumber,
            'invitation_sender_id'=>$this->request->invitedId,
        ]);
         return $user;
    }
}
