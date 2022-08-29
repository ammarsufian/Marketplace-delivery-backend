<?php

namespace App\Domains\AccountManagement\Services;

use App\Domains\AccountManagement\Actions\EditProfileAction;
use App\Domains\AccountManagement\Http\Requests\EditProfileRequest;
use App\Domains\Authentication\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;


class UserService
{
    public function editProfile(EditProfileRequest $request)
    {
        try {
            $user = Auth::user();
            (new EditProfileAction($request,$user))->execute();
        }catch (\Exception $exception)
        {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false
            ],400);
        }

        return UserResource::make($user->refresh());
    }
}
