<?php

namespace App\Domains\ApplicationManagement\Http\Controllers;

use App\Http\Controllers\Controller;

class termsConditionsController extends Controller
{

    public function __invoke()
    {
        return view('TermsConditionsPage');
    }
}