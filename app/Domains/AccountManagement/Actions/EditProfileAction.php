<?php

namespace App\Domains\AccountManagement\Actions;

use App\Domains\AccountManagement\Http\Requests\EditProfileRequest;
use App\Domains\Authentication\Models\User;
use App\Domains\Interfaces\Actionable;
use Illuminate\Http\Request;


class EditProfileAction implements Actionable
{
    protected Request $request;
    protected User $user;

    public function __construct(EditProfileRequest $request, User $user)
    {
        $this->request = $request;
        $this->user = $user;
    }

    public function execute(): bool
    {
        return $this->user->update([
            'mobile_number' => $this->request->get('mobile_number') ?? $this->user->mobile_number,
            'name' => $this->request->get('name') ?? $this->user->name,
            'email' => $this->request->get('email') ?? $this->user->email,
        ]);
    }
}
