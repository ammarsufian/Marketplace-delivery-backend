<?php

namespace App\Domains\Authentication\Actions;

use App\Domains\Authentication\Http\Requests\RegisterUserRequest;
use App\Domains\Authentication\Models\User;
use App\Domains\Interfaces\Actionable;
use Illuminate\Http\Request;

class RegisterUserAction implements Actionable
{
    protected Request $request;

    public function __construct(RegisterUserRequest $request)
    {
        $this->request = $request;
    }

    public function execute(): User
    {
        $user = User::create([
            'mobile_number' => $this->request->get('mobile_number'),
        ]);

	$user->assignRole('application');

	return $user;
    }
}
