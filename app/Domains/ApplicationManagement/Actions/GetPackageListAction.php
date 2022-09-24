<?php

namespace App\Domains\ApplicationManagement\Actions;

use App\Domains\Interfaces\Actionable;
use App\Domains\ApplicationManagement\Models\Package;
use App\Domains\Authentication\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetPackageListAction implements Actionable
{
    protected User $user;
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->user = Auth::user();
        $this->request = $request;
    }

    public function execute()
    {
        return Package::ofActive()->paginate($this->request->get('per_page', 5));
    }
}
