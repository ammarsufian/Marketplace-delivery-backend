<?php

namespace App\Domains\ApplicationManagement\Actions;

use App\Domains\Interfaces\Actionable;
use App\Domains\ApplicationManagement\Models\Package;
use App\Domains\Authentication\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class GetPackageListAction implements Actionable
{
    protected User $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }
    public function execute(): Collection
    {
        return Package::when($this->user->hasRole(User::APPLICATION_ROLE),
                function (Builder $query) {
                    $query->where('is_active', true);
             })->where('is_active', true)->get();
    }
}
