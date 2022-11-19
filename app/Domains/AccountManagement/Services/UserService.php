<?php

namespace App\Domains\AccountManagement\Services;

use App\Domains\AccountManagement\Actions\EditProfileAction;
use App\Domains\AccountManagement\Http\Requests\EditProfileRequest;
use App\Domains\Authentication\Http\Resources\UserResource;
use App\Domains\Authentication\Rules\CheckGuestRule;
use App\Exceptions\RuleResultException;
use App\Rules\Rules;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function editProfile(EditProfileRequest $request)
    {
        try {
            $user = Auth::user();
            $ruleResults = Rules::apply([
                (new CheckGuestRule($user))
            ]);

            if ($ruleResults->hasFailures())
                $ruleResults->toException();

            (new EditProfileAction($request, $user))->execute();
        } catch (RuleResultException $exception) {
            return $exception->ruleResult()->toExceptionResponse();
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false
            ], 400);
        }

        return UserResource::make($user->refresh());
    }

    public function getProfile()
    {
        try {
            $user = Auth::user();
            $ruleResults = Rules::apply([
                (new CheckGuestRule($user))
            ]);

            if ($ruleResults->hasFailures())
                $ruleResults->toException();

            return UserResource::make($user);

        } catch (RuleResultException $exception) {
            return $exception->ruleResult()->toExceptionResponse();
        }
    }
}
