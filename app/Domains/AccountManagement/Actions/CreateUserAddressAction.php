<?php

namespace App\Domains\AccountManagement\Actions;

use App\Domains\AccountManagement\Http\Requests\CreateUserAddressRequest;
use App\Domains\AccountManagement\Models\Address;
use App\Domains\ApplicationManagement\Actions\GetCityByNameAction;
use App\Domains\ApplicationManagement\Models\City;
use App\Domains\Interfaces\Actionable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateUserAddressAction implements Actionable
{
    protected Request $request;
    protected City $city;

    public function __construct(CreateUserAddressRequest $request)
    {
        $this->request = $request;
        $this->city = (new GetCityByNameAction($request->get('city_name')))
            ->execute();
    }

    public function execute(): Address
    {
        return Auth::user()->addresses()->create([
            'latitude' => $this->request->get('latitude'),
            'longitude' => $this->request->get('longitude'),
            'type' => $this->request->get('type'),
            'is_default' => $this->request->get('is_default'),
            'city_id' => $this->city->id,
            'details' => $this->request->get('details')
        ]);
    }
}
