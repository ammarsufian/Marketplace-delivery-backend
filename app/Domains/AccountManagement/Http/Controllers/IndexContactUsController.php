<?php

namespace App\Domains\AccountManagement\Http\Controllers;

use App\Http\Controllers\Controller;

class IndexContactUsController extends Controller
{

    public function __invoke()
    {
        return view('contactPage');
    }
}