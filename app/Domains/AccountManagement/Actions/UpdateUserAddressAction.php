<?php

namespace App\Domains\AccountManagement\Actions;

use App\Domains\AccountManagement\Http\Requests\UpdateUserAddressRequest;
use App\Domains\AccountManagement\Models\Address;
use App\Domains\ApplicationManagement\Actions\GetCityByNameAction;
use App\Domains\ApplicationManagement\Models\City;
use App\Domains\Interfaces\Actionable;
use Illuminate\Http\Request;

class UpdateUserAddressAction implements Actionable
{
    protected Address $address;
    protected Request $request;
    protected City $city;

    public function __construct(Address $address, UpdateUserAddressRequest $request)
    {
        $this->address = $address;
        $this->request = $request;
        $this->city = (new GetCityByNameAction($request->get('city_name')))
            ->execute();
    }

    public function execute(): bool
    {
        return $this->address->update([
            'is_default' => $this->request->get('is_default'),
            'latitude' => $this->request->get('latitude'),
            'longitude' => $this->request->get('longitude'),
            'city_id' => $this->city->id,
            'details' => $this->request->get('details'),
        ]);
    }
}
