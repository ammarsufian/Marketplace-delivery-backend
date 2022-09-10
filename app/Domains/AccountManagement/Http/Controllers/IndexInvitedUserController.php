<?php

namespace App\Domains\AccountManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Domains\AccountManagement\Services\InvitationFriendService;

class IndexInvitedUserController extends Controller
{

    public function __invoke($referral_key, InvitationFriendService $invitationLink)
    {
        if ($invitationLink->CheckInvitationLink($referral_key))
            return view('InvitationPage', compact('referral_key'));

        abort(404, "Invitation link is not valid");
    }

}
