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

class ProviderAuthenticationService
{

    public function login(LoginProviderRequest $request)
    {
        try {
            $user = (new LoginProviderAction($request))->execute();
             throw_if(!(Hash::check($request->get('password'), $user->password)), Exception::class, 'Invalid password');
             throw_if(!$user->is_active, Exception::class, 'User is not active');
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false
            ], 400);
        }
        return UserAuthenticationResource::make($user);

    }

    public function register(RegisterProviderRequest $request)
    {
        try {
            $user = (new RegisterProviderAction($request))->execute();

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
