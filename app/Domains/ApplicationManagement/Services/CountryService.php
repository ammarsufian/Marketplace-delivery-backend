<?php

namespace App\Domains\ApplicationManagement\Services;


use Exception;
use Illuminate\Http\Request;
use App\Domains\ApplicationManagement\Actions\GetCountriesListAction;

class CountryService
{
    public function index(Request $request)
    {
        try {
            $results = (new GetCountriesListAction($request))->execute();   
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false
            ], 400);
        }
        return $results;
    }
}
