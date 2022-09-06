<?php

namespace App\Domains\Authentication\Actions;

use Illuminate\Http\Request;
use App\Domains\Interfaces\Actionable;
use App\Domains\Authentication\Models\User;
use App\Domains\Authentication\Http\Requests\RegisterProviderRequest;
use Illuminate\Support\Facades\Hash;

class RegisterProviderAction implements Actionable
{
    protected Request $request;

    public function __construct(RegisterProviderRequest $request)
    {
        $this->request = $request;
    }

    public function execute(): User
    {
        $user = User::create([
            'mobile_number' => $this->request->get('mobile_number'),
            'password' => Hash::make($this->request->get('password')),
            'is_active' => 1,
        ]);
        $user->assignRole(User::PROVIDER_ROLE);
	    return $user;
    }
}
