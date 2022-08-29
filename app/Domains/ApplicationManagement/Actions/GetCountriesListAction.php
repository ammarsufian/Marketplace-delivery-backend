<?php

namespace App\Domains\ApplicationManagement\Actions;

use App\Domains\ApplicationManagement\Models\Country;
use App\Domains\Interfaces\Actionable;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class GetCountriesListAction implements Actionable
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function execute()
    { 
        return Country::all()->load('cities');
    }
}