<?php

namespace App\Domains\Authentication\Actions;

use App\Domains\Authentication\Http\Requests\LoginUserRequest;
use App\Domains\Authentication\Models\User;
use App\Domains\Interfaces\Actionable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use function App\Helpers\mobile;

class LoginUserAction implements Actionable
{
    protected Request $request;
    protected string $role_name;

    public function __construct(LoginUserRequest $request, string $role_name)
    {
        $this->request = $request;
        $this->role_name = $role_name;
    }

    public function execute(): ?User
    {
        return User::whereHas('roles', function (Builder $query) {
            return $query->where('name', $this->role_name);
        })->where('mobile_number', mobile($this->request->get('mobile_number')))
            ->firstOrFail();
    }
}
