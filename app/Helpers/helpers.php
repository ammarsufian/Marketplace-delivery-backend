<?php

namespace App\Helpers;

use App\Domains\AccountManagement\Models\Address;
use Illuminate\Support\Facades\Auth;

if (!function_exists('mobile')) {
    function mobile($mobile_number): ?string
    {
        return substr(str_replace('-', '', $mobile_number), -9);
    }
}

if (!function_exists('activeAddress')) {
    function activeAddress(): ?Address
    {
        if (isset(request()->addressId)) {
            return Address::where('user_id', Auth::user()->id)
                ->where('id', request()->addressId)
                ->first();
        }

        return Address::where('user_id', Auth::user()->id)
            ->first();
    }
}
