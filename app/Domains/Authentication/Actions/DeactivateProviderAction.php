<?php

namespace App\Domains\Authentication\Actions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Domains\Interfaces\Actionable;
use App\Domains\Authentication\Models\User;

class DeactivateProviderAction implements Actionable
{
    protected Request $request;
    protected User $user;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->user = Auth::user();
    }

    public function execute(): User
    {
        $this->user->update(['is_active' => false]);
        return $this->user->refresh();
    }
}
