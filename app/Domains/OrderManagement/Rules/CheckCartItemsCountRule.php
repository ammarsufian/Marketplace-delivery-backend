<?php

namespace App\Domains\OrderManagement\Rules;

use App\Domains\Interfaces\Rulable;
use Illuminate\Support\Facades\Auth;

class CheckCartItemsCountRule implements Rulable
{
    public function run(): bool
    {
        return (bool)Auth::user()->cart->items->count();
    }

    public function getMessage(): string
    {
        return 'should you have a minimum one item in cart ';
    }
}
