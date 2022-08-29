<?php

namespace App\Domains\AccountManagement\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\AccountManagement\Services\NewJoinerService;
use App\Domains\AccountManagement\Http\Requests\NewJoinerRequest;

class NewJoinerController extends Controller
{

    public function __invoke(NewJoinerRequest $request, NewJoinerService $joinUserService)
    {
        $joinUserService->create($request);
        return redirect()->route('landing-page');
    }
}
