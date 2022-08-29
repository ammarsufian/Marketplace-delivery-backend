<?php

namespace App\Domains\AccountManagement\Rules;

use App\Domains\Interfaces\Rulable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ModelInstanceBelongsToActiveUserRule implements Rulable
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function run(): bool
    {
        return $this->model->user_id === Auth::user()->id;
    }

    public function getMessage(): string
    {
        return 'selected address dose not belongs to you ';
    }
}
