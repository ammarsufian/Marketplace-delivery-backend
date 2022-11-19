<?php

namespace App\Domains\AccountManagement\Http\Controllers;

use App\Domains\AccountManagement\Services\UserService;
use App\Domains\AccountManagement\Http\Requests\EditProfileRequest;
use App\Domains\Authentication\Http\Resources\UserResource;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function show(UserService $userService)
    {
        return $userService->getProfile();
    }

    public function update(EditProfileRequest $request, UserService $userService)
    {
        return $userService->editProfile($request);
    }
}
