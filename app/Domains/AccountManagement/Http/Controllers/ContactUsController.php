<?php

namespace App\Domains\AccountManagement\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\AccountManagement\Services\ContactUsService;

class ContactUsController extends Controller
{


    public function index()
    {
        return view('contactPage');
    }

    public function store(Request $request, ContactUsService $ContactUsService)
    {
        $ContactUsService->create($request);
        return redirect()->route('landing-page');
    }
}
