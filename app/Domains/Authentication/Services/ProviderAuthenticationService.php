<?php

namespace App\Domains\Authentication\Services;

use Exception;
use Illuminate\Http\Request;
use App\Domains\Authentication\Actions\LogoutUserAction;
use App\Domains\Authentication\Actions\LoginProviderAction;
use App\Domains\Authentication\Actions\DeactivateProviderAction;
use App\Domains\Authentication\Http\Requests\LoginProviderRequest;
use App\Domains\Authentication\Http\Resources\UserAuthenticationResource;
use App\Rules\Rules;
use App\Domains\Authentication\Rules\CheckIfUserIsActiveRule;
use App\Domains\Authentication\Rules\CheckPasswordRule;
use Illuminate\Support\Facades\Log;

class ProviderAuthenticationService
{

    public function login(LoginProviderRequest $request)
    {
        try {
            $user = (new LoginProviderAction($request))->execute();

            $ruleResults = Rules::apply([
                (new CheckPasswordRule($request->get('password'), $user)),
                (new CheckIfUserIsActiveRule($user)),
            ]);

            if ($ruleResults->hasFailures())
                $ruleResults->toException();

        } catch (Exception $exception) {
            Log::Error('USER ERRORS' . $exception->getMessage());
            return response()->json([
                'message' => "User Not found",
                'success' => false
            ], 400);
        }

        return UserAuthenticationResource::make($user);
    }

    public function logout(Request $request)
    {
        try {
            (new LogoutUserAction($request))->execute();
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false
            ], 400);
        }

        return response()->json([
            'message' => 'User logged out successfully',
            'success' => true,
        ]);
    }


    public function deactivate(Request $request)
    {
        try {
            $user = (new DeactivateProviderAction($request))->execute();
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false
            ], 400);
        }

        return response()->json([
            'message' => "User deactivated successfully",
            'success' => true,
            'is_active' => $request->get('is_active')
        ]);
    }
}
