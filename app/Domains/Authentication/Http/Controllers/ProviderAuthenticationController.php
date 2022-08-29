<?php

namespace App\Domains\Authentication\Http\Controllers;

use App\Domains\Authentication\Http\Requests\LoginUserRequest;
use App\Domains\Authentication\Models\User;
use App\Domains\Authentication\Services\AuthenticationService;
use App\Http\Controllers\Controller;

class ProviderAuthenticationController extends Controller
{
    public function login(LoginUserRequest $request, AuthenticationService $authenticationService)
    {
        return $authenticationService->login($request, User::PROVIDER_ROLE);
    }
}
