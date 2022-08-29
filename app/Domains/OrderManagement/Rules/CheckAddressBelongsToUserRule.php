<?php

namespace App\Domains\OrderManagement\Rules;

use App\Domains\AccountManagement\Models\Address;
use App\Domains\Interfaces\Rulable;
use Illuminate\Support\Facades\Auth;

class CheckAddressBelongsToUserRule implements Rulable
{
    protected Address $address;

    public function __construct(Address $address)
    {
        $this->address = $address;
    }

    public function run(): bool
    {
        return $this->address->user_id === Auth::user()->id;
    }

    public function getMessage(): string
    {
        return 'Address Dose not belongs to active user'; //TODO::to be translatable by data team
    }
}
