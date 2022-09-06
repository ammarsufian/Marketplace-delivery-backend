<?php

namespace App\Domains\Authentication\Actions;

use Illuminate\Http\Request;
use function App\Helpers\mobile;
use App\Domains\Interfaces\Actionable;
use Illuminate\Database\Eloquent\Builder;
use App\Domains\Authentication\Models\User;
use App\Domains\Authentication\Http\Requests\LoginProviderRequest;

class LoginProviderAction implements Actionable
{
    protected Request $request;

    public function __construct(LoginProviderRequest $request )
    {
        $this->request = $request;
    }

    public function execute(): ?User
    {
        return User::whereHas('roles', function (Builder $query) {
            return $query->where('name', User::PROVIDER_ROLE);
        })->where('mobile_number', mobile($this->request->get('mobile_number')))
            ->firstOrFail();
    }

}
