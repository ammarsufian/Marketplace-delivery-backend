<?php

namespace App\Domains\AccountManagement\Services;

use App\Domains\AccountManagement\Actions\CheckInvitationLinkAction;
use App\Domains\AccountManagement\Rules\CheckInvitedFriendsOtpRule;
use App\Domains\Authentication\Rules\CheckIfUserIsActiveRule;
use App\Rules\Rules;
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
            'data' => [$result],
            'success' => true
        ]);
    }

    public function CheckInvitationLink($referral_key)
    {
        return (new CheckInvitationLinkAction($referral_key))->execute();
    }

    public function sendOTP(InvitedUserRequest $request)
    {
        try {
            return (new WebOtpService())->sendOTP($request->get('mobile_number'));
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false
            ], 400);
        }
    }

    public function createUser(InvitedUserRequest $request)
    {

        try {

            throw_if(empty($request->otp), 'OTP is required');
           //  return $request;
                $ruleResults = Rules::apply([
                    (new CheckInvitedFriendsOtpRule($request->mobile_number, $request->otp)),
                 ]);
                if ($ruleResults->hasFailures()){
                    $ruleResults->toException();
                }
              //  (new CreateInvitedUserAction($request))->execute();

        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false
            ], 422);
        }

        return response()->json([
            'message' => 'Account Created',  //TODO::make this message Translated
            'success' => true
        ]);
    }
}
