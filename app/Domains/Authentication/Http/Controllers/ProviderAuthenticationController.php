<?php

namespace App\Domains\Authentication\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\Authentication\Models\User;
use App\Domains\Authentication\Http\Requests\LoginProviderRequest;
use App\Domains\Authentication\Http\Requests\RegisterProviderRequest;
use App\Domains\Authentication\Services\ProviderAuthenticationService;

class ProviderAuthenticationController extends Controller
{
    public function login(LoginProviderRequest $request, ProviderAuthenticationService $providerAuthenticationService)
    {
        return $providerAuthenticationService->login($request);
    }

    public function logout(Request $request, ProviderAuthenticationService $providerAuthenticationService)
    {
        return $providerAuthenticationService->logout($request);
    }

    public function deactivate(Request $request, ProviderAuthenticationService $providerAuthenticationService)
    {
        return $providerAuthenticationService->deactivate($request);
    }
}
