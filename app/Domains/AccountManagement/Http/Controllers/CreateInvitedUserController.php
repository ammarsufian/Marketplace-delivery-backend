<?php

namespace App\Domains\AccountManagement\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\AccountManagement\Services\InvitationFriendService;
use App\Domains\AccountManagement\Http\Requests\InvitedUserRequest;

class CreateInvitedUserController extends Controller
{
    public function __invoke(InvitedUserRequest $request , InvitationFriendService $invitationLink)
    {
        return $invitationLink->createUser($request);
    }
}
