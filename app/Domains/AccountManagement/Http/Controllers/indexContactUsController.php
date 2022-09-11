<?php

namespace App\Domains\AccountManagement\Http\Controllers;

use App\Http\Controllers\Controller;

class indexContactUsController extends Controller
{

    public function __invoke()
    {
        return view('contactPage');
    }
}
