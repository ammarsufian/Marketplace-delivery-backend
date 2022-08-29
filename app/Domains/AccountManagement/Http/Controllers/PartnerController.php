<?php

namespace App\Domains\AccountManagement\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\ApplicationManagement\Models\Country;
use App\Domains\ApplicationManagement\Services\CountryService;

class PartnerController extends Controller
{
    public function __invoke(Request $request, CountryService $CountryService)
    {
        $countries = $CountryService->index($request);
        $SaudiaId= Country::SAUDIA_COUNTRY_ID;
        return view('partnerPage', compact('countries','SaudiaId'));
      
    }
    
}
    