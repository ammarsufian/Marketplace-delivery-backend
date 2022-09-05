<?php

namespace App\Domains\AccountManagement\Services;

use App\Domains\AccountManagement\Actions\CeackInvitationLinkAction;
use Exception;
use Illuminate\Http\Request;
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
            'message' => 'Link Generated', //TODO::make this message Translated
            'data' => $result,
            'success' => true
        ]);
    }
    public function CeackInvitationLink($referral_key)
    {
        return (new CeackInvitationLinkAction($referral_key))->execute();
    }
    public function createUser(InvitedUserRequest $request)
    {

        try {
            //TODO:: Role to sms otp user
            if ($request->get('sms')=='sms') {
                (new CreateInvitedUserAction($request))->execute();
            } else {
                throw new Exception('Invalid OTP');
            }
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false
            ], 400);
        }

        return response()->json([
            'message' => 'Account Created',  //TODO::make this message Translated
            'success' => true
        ]);
    }
}
