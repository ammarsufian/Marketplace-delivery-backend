<?php

namespace App\Domains\Authentication\Http\Controllers;

use App\Domains\Authentication\Http\Resources\UserAuthenticationResource;
use App\Domains\Authentication\Models\User;
use App\Http\Controllers\Controller;

class GuestModeController extends Controller
{

    public function __invoke()
    {
        $guest = user::ofEmail('guest@cova.com')->first();
        return response()->json([
            'active' => true,
            'guest' => UserAuthenticationResource::make($guest),
        ]);
    }
}
