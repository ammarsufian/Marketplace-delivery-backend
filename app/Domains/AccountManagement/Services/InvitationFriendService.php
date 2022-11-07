<?php

namespace App\Domains\AccountManagement\Services;

use Exception;
use App\Rules\Rules;
use Illuminate\Http\Request;
use App\Domains\Transaction\Models\UserTransaction;
use App\Domains\AccountManagement\Services\SmsService;
use App\Domains\Transaction\Actions\CreatePointsAction;
use App\Domains\Authentication\Rules\CheckIfUserIsActiveRule;
use App\Domains\AccountManagement\Actions\CreateInvitedUserAction;
use App\Domains\AccountManagement\Actions\GetInvitationLinkAction;
use App\Domains\AccountManagement\Http\Requests\InvitedUserRequest;
use App\Domains\AccountManagement\Rules\CheckInvitedFriendsOtpRule;
use App\Domains\AccountManagement\Actions\CheckInvitationLinkAction;

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
            return (new SmsService())->sendOTP($request->get('mobile_number'));
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
            $ruleResults = Rules::apply([
                (new CheckInvitedFriendsOtpRule($request->get("mobile_number"), $request->get("otp"))),
            ]);
            if ($ruleResults->hasFailures()) {
                $ruleResults->toException();
            }

            $user=(new CreateInvitedUserAction($request))->execute();
            (new CreatePointsAction($user,UserTransaction::POINTS_STATUS_PENDING,UserTransaction::POINTS_REASON))->execute();

        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false
            ], 422);
        }

        return response()->json([
            'message' => __('auth.registered_successfully'),
            'success' => true
        ]);
    }
}
