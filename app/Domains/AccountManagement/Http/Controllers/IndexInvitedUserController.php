<?php

namespace App\Domains\AccountManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Domains\AccountManagement\Services\InvitationFriendService;


       // return view('InvitationPage', compact('id'));
class IndexInvitedUserController extends Controller
{
    public function __invoke($referral_key, InvitationFriendService $invitationLink)
    {
        if ($invitationLink->CeackInvitationLink($referral_key)) {
            return view('InvitationPage', compact('referral_key'));
        } else {
            abort(404);
        }
    }

}
