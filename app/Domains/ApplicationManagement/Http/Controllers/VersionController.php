<?php

namespace App\Domains\ApplicationManagement\Http\Controllers;

use App\Domains\ApplicationManagement\Http\Requests\VersionCheckRequest;

class VersionController
{
    public function __invoke(VersionCheckRequest $request)
    {
        return response()->json([
            'force_update' => false,
            'current_version' => '1.0.02',
            'operating_system' => $request->get('operating_system')
        ]);
    }

}
