<?php

namespace App\Domains\AccountManagement\Actions;

use App\Domains\AccountManagement\Http\Requests\NewJoinerRequest;
use App\Domains\AccountManagement\Models\NewJoiner;
use App\Domains\Interfaces\Actionable;
use Illuminate\Http\Request;

class CreateNewJoinerAction implements Actionable
{
    protected Request $request;

    public function __construct(NewJoinerRequest $request)
    {
        $this->request = $request;
    }

    public function execute(): NewJoiner
    {
        return NewJoiner::create([
            'name' => $this->request->get('firstName') . ' ' . $this->request->get('lastName'),
            'mobile_number' => $this->request->get('phoneNumber'),
            'type' => $this->request->get('type'),
            'status' => 'pending',
            'city_id' => $this->request->get('city'),
        ]);
    }
}
