<?php

namespace App\Domains\AccountManagement\Actions;

use Illuminate\Http\Request;

use App\Domains\Interfaces\Actionable;
use App\Domains\AccountManagement\Models\ContactUs;

class CreateContactUsAction implements Actionable
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function execute()
    {
        return ContactUs::create([
            'name' => $this->request->get('firstName') . ' ' . $this->request->get('lastName'),
            'email' => $this->request->get('email'),
            'message' => $this->request->get('message'),
        ]);
    }
}
