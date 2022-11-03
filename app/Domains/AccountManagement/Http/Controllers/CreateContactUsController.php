<?php

namespace App\Domains\AccountManagement\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\AccountManagement\Services\ContactUsService;

class createContactUsController extends Controller
{
    public function __invoke(Request $request, ContactUsService $ContactUsService)
    {
        $ContactUsService->create($request);
        return redirect()->route('landing-page', app()->getLocale());
    }
}