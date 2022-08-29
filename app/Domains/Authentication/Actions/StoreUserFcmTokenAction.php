<?php

namespace App\Domains\Authentication\Actions;

use App\Domains\Authentication\Http\Requests\UpdateFcmTokenRequest;
use App\Domains\Interfaces\Actionable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreUserFcmTokenAction implements Actionable
{
    protected Request $request;

    public function __construct(UpdateFcmTokenRequest $request)
    {
        $this->request = $request;
    }

    public function execute()
    {
        return Auth::user()->currentAccessToken()->update([
            'fcm_token' => $this->request->get('fcm_token')
        ]);
    }
}
