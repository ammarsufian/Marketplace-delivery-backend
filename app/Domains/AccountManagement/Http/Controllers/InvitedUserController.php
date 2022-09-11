<?php

namespace App\Domains\AccountManagement\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\AccountManagement\Http\Requests\InvitedUserRequest;
use App\Domains\AccountManagement\Services\InvitationFriendService;

class InvitedUserController extends Controller
{
    public function index(Request $request , InvitationFriendService $invitationLink)
    {
        return $invitationLink->GetInvitationLink($request);
    }

    public function check($referral_key,InvitedUserRequest $request, InvitationFriendService $invitationLink)
    {
        // limit the request to 5 times
        return $request->get('token');
    }

    public function create($referral_key,InvitedUserRequest $request, InvitationFriendService $invitationLink)
    {
        if ($invitationLink->CheckInvitationLink($referral_key))
            return $invitationLink->createUser($request);
    }


    public function show($referral_key, InvitationFriendService $invitationLink)
    {
        if ($invitationLink->CheckInvitationLink($referral_key))
            return view('InvitationPage', compact('referral_key'));

        abort(404, "Invitation link is not valid");
    }

}
