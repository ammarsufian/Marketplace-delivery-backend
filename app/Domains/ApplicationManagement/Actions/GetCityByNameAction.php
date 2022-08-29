<?php

namespace App\Domains\ApplicationManagement\Actions;

use App\Domains\ApplicationManagement\Models\City;
use App\Domains\ApplicationManagement\Models\Country;
use App\Domains\Interfaces\Actionable;

class GetCityByNameAction implements Actionable
{
    protected string $cityName;

    public function __construct(string $cityName)
    {
        $this->cityName = $cityName;
    }

    public function execute()
    {
        return City::where('name->en', $this->cityName)
            ->orWhere('name->ar', $this->cityName)
            ->firstOrCreate([
                'name' => ['en' => $this->cityName, 'ar' => $this->cityName],
                'country_id' => Country::SAUDIA_COUNTRY_ID
            ]);
    }
}
