<?php

namespace App\Domains\Authentication\Services;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Domains\Authentication\Actions\LogoutUserAction;
use App\Domains\Authentication\Actions\LoginProviderAction;
use App\Domains\Authentication\Actions\RegisterProviderAction;
use App\Domains\Authentication\Actions\DeactivateProviderAction;
use App\Domains\Authentication\Http\Requests\LoginProviderRequest;
use App\Domains\Authentication\Http\Requests\RegisterProviderRequest;
use App\Domains\Authentication\Http\Resources\UserAuthenticationResource;
use App\Rules\Rules;
use App\Domains\Authentication\Rules\CheckIfUserIsActiveRule;
use App\Domains\Authentication\Rules\CheckPasswordRule;

class ProviderAuthenticationService
{

    public function login(LoginProviderRequest $request)
    {
        try {
            $user = (new LoginProviderAction($request))->execute();
            $ruleResults = Rules::apply([
                (new CheckPasswordRule($request->get('password'),$user)),
            ]);
            if($ruleResults->hasFailures())
                $ruleResults->toException();

        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
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
