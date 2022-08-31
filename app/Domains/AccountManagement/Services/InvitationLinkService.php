<?php

namespace App\Domains\AccountManagement\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Domains\AccountManagement\Actions\CreateInvitedUserAction;
use App\Domains\AccountManagement\Actions\GetInvitationLinkAction;
use App\Domains\AccountManagement\Http\Requests\InvitedUserRequest;

class InvitationLinkService
{
    public function GetInvitationLink(Request $request)
    {
        try {
            $user = Auth::user();
            $result=(new GetInvitationLinkAction($user))->execute();
        }catch (\Exception $exception)
        {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false
            ],400);
        }

        return response()->json([
            'message' => 'Link Generated',
            'link' => $result,
            'success' => true
        ],200);
    }
    public function createUser(InvitedUserRequest $request)
    {
        try {
            if(Hash::check($request->get('invitedId'),$request->get('invitedBy')))
            {
                if($request->has('sms'))
                {
                    //TODO:: otp verification Api call
                    return $result=(new CreateInvitedUserAction($request))->execute();
                }
                else
                {
                    return response()->json([
                        'message' => 'SMS is not sent',
                        'success' => true
                    ],200);
                }
            }
            else
            {
                return response()->json([
                    'message' => 'Invalid Key',
                    'success' => false
                ],400);
            }
        }catch (\Exception $exception)
        {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false
            ],400);
        }

        return $result;
    }
}
