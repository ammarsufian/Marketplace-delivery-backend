<?php

namespace App\Domains\AccountManagement\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\AccountManagement\Services\InvitationLinkService;
use App\Domains\AccountManagement\Http\Requests\InvitedUserRequest;

class CreateInvitedUserController extends Controller
{
    protected Request $request;
    public function __invoke(InvitedUserRequest $request , InvitationLinkService $invitationLink)
    {
        return $invitationLink->createUser($request);
    }
}