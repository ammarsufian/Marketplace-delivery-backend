<?php

namespace App\Domains\AccountManagement\Actions;

use App\Domains\AccountManagement\Models\Address;
use App\Domains\Interfaces\Actionable;

class DeleteUserAddressAction implements Actionable
{
    protected Address $address;

    public function __construct(Address $address)
    {
        $this->address = $address;
    }

    public function execute(): bool
    {
        return $this->address->delete();
    }
}
