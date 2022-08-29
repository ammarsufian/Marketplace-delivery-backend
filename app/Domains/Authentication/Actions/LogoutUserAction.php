<?php

namespace App\Domains\Authentication\Actions;

use App\Domains\Interfaces\Actionable;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Auth;

class LogoutUserAction implements Actionable
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function execute(): bool
    {
        return $this->request->user()->currentAccessToken()->delete();
    }
}
