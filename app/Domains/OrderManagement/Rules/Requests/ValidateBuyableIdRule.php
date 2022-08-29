<?php

namespace App\Domains\OrderManagement\Rules\Requests;

use App\Domains\OrderManagement\Models\CartItem;
use Illuminate\Contracts\Validation\Rule;

class ValidateBuyableIdRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        if (isset(CartItem::BUYABLE_MODELS[request()->buyable_type]))
            return app(CartItem::BUYABLE_MODELS[request()->buyable_type])->where('id', $value)->exists();
        return false;
    }

    public function message(): string
    {
        return 'Invalid buyable id ';
    }
}
