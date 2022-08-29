<?php
namespace App\Domains\AccountManagement\Http\Controllers;

use App\Domains\AccountManagement\Services\UserService;
use App\Domains\AccountManagement\Http\Requests\EditProfileRequest;
use Illuminate\Routing\Controller;

class EditProfileController extends Controller
{

    public function update(EditProfileRequest $request,UserService $userService)
    {
        return $userService->editProfile($request);
    }
}
