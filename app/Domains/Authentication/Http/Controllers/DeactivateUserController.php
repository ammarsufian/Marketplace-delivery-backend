<?php

namespace App\Domains\Authentication\Http\Controllers;

use App\Domains\Authentication\Services\AuthenticationService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeactivateUserController extends Controller
{
    public function __invoke(Request $request, AuthenticationService $authenticationService)
    {
        return $authenticationService->deactivateUser($request);
    }
}
