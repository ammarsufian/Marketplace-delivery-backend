<?php

namespace App\Domains\AccountManagement\Http\Controllers;

use App\Domains\AccountManagement\Http\Requests\CreateUserAddressRequest;
use App\Domains\AccountManagement\Http\Requests\UpdateUserAddressRequest;
use App\Domains\AccountManagement\Models\Address;
use App\Domains\AccountManagement\Services\AddressService;
use App\Http\Controllers\Controller;

class AddressesController extends Controller
{

    public function store(CreateUserAddressRequest $request, AddressService $addressService)
    {
        return $addressService->createUserAddress($request);
    }

    public function index(AddressService $addressService)
    {
        return $addressService->UserAddressesList();
    }

    public function update(Address $address, UpdateUserAddressRequest $request, AddressService $addressService)
    {
        return $addressService->updateUserAddress($address, $request);
    }

    public function destroy(Address $address, AddressService $addressService)
    {
        return $addressService->deleteUserAddress($address);
    }
}
