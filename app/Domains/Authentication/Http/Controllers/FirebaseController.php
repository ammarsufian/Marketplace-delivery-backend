<?php

namespace App\Domains\Authentication\Http\Controllers;

use App\Domains\Authentication\Http\Requests\UpdateFcmTokenRequest;
use App\Domains\Authentication\Services\AuthenticationService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class FirebaseController extends Controller
{

    public function __invoke(UpdateFcmTokenRequest $request, AuthenticationService $authenticationService): JsonResponse
    {
        return $authenticationService->updateFcmToken($request);
    }

}
