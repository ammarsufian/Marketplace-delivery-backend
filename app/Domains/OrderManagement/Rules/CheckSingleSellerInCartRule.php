<?php

namespace App\Domains\OrderManagement\Rules;

use App\Domains\Interfaces\Rulable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CheckSingleSellerInCartRule implements Rulable
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function run(): bool
    {

        return in_array($this->model->branch_id, Auth::user()->cart->items()->pluck('branch_id'));
    }

    public function getMessage(): string
    {
        return 'please remove cart items from another seller';//TODO::make it translated
    }
}
