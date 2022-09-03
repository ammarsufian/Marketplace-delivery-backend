<?php

namespace App\Domains\AccountManagement\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\AccountManagement\Services\InvitationFriendService;

class IndexInvitedUserController extends Controller
{
    public function __invoke(Request $request, $id)
    {
        return view('InvitationPage', compact('id'));
    }

}

