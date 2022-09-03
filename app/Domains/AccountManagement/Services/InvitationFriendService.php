<?php

namespace App\Domains\AccountManagement\Services;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Domains\AccountManagement\Actions\CreateInvitedUserAction;
use App\Domains\AccountManagement\Actions\GetInvitationLinkAction;
use App\Domains\AccountManagement\Http\Requests\InvitedUserRequest;

class InvitationFriendService
{
    public function GetInvitationLink(Request $request)
    {
        try {
            $result = (new GetInvitationLinkAction())->execute();
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false
            ], 400);
        }

        return response()->json([
            'message' => 'Link Generated',//TODO::make this message Translated
            'data' => $result,
            'success' => true
        ]);
    }

    public function createUser(InvitedUserRequest $request)
    {
        try {
            $results = (new CreateInvitedUserAction($request))->execute();

        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false
            ], 400);
        }

        return $results;
    }
}
