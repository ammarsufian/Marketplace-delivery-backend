<?php

namespace App\Domains\Authentication\Http\Controllers;

use App\Domains\Authentication\Http\Requests\LoginUserRequest;
use App\Domains\Authentication\Http\Requests\RegisterUserRequest;
use App\Domains\Authentication\Models\User;
use App\Domains\Authentication\Services\AuthenticationService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{

    public function login(LoginUserRequest $request, AuthenticationService $authenticationService)
    {
        return $authenticationService->login($request,User::APPLICATION_ROLE);
    }

    public function register(RegisterUserRequest $request, AuthenticationService $authenticationService)
    {
        return $authenticationService->register($request);
    }

    public function logout(Request $request, AuthenticationService $authenticationService)
    {
        return $authenticationService->logout($request);
    }
}
