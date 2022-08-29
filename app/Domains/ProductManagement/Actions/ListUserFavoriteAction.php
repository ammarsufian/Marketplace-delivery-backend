<?php

namespace App\Domains\ProductManagement\Actions;

use App\Domains\Interfaces\Actionable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListUserFavoriteAction implements Actionable
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function execute()
    {
        return Auth::user()->favorites;
    }
}
