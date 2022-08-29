<?php

namespace App\Domains\AccountManagement\Actions;

use App\Domains\AccountManagement\Http\Requests\CreateUserFavoriteRequest;
use App\Domains\Interfaces\Actionable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateUserFavoriteAction implements Actionable
{
    protected Request $request;

    public function __construct(CreateUserFavoriteRequest $request)
    {
        $this->request = $request;
    }

    public function execute()
    {
        return Auth::user()->favorites()
            ->create([
                'branch_id' => $this->request->get('branch_id')
            ]);
    }
}
