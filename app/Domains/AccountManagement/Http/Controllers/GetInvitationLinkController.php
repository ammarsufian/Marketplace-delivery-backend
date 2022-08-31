<?php

namespace App\Domains\AccountManagement\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\AccountManagement\Services\InvitationLinkService;

class GetInvitationLinkController extends Controller
{
    public function __invoke(Request $request , InvitationLinkService $invitationLink)
    {
        return $invitationLink->GetInvitationLink($request);
    }

}
 