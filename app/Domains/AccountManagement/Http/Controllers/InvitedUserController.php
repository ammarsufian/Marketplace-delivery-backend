<?php

namespace App\Domains\AccountManagement\Http\Controllers;

use App\Domains\AccountManagement\Services\SmsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\AccountManagement\Http\Requests\InvitedUserRequest;
use App\Domains\AccountManagement\Services\InvitationFriendService;

class InvitedUserController extends Controller
{
    public function index(Request $request, InvitationFriendService $invitationFriendService)
    {
        return $invitationFriendService->GetInvitationLink($request);
    }

    public function check($referral_key, InvitedUserRequest $request, SmsService $smsService)
    {
        // limit the request to 5 times
        //return $smsService->sendOTP($request->get('mobile_number'));
    }

    public function create($referral_key, InvitedUserRequest $request, InvitationFriendService $invitationFriendService)
    {
        if ($invitationFriendService->CheckInvitationLink($referral_key))
            return $invitationFriendService->createUser($request);
    }


    public function show($lang,$referral_key, InvitationFriendService $invitationFriendService)
    {
        if ($invitationFriendService->CheckInvitationLink($referral_key))
            return view('InvitationPage', compact('referral_key'));

        abort(404, "Invitation link is not valid");
    }

}
