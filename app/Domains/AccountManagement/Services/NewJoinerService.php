<?php

namespace App\Domains\AccountManagement\Services;

use Exception;
use Illuminate\Http\Request;
use App\Domains\AccountManagement\Actions\CreateNewJoinerAction;
use App\Domains\AccountManagement\Http\Requests\NewJoinerRequest;

class NewJoinerService
{

    public function create(NewJoinerRequest $request)
    {
        try {
            (new CreateNewJoinerAction($request))->execute();
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false,
            ], 400);
        }
        return (response()->json([
            'message' => 'Successfully created',
            'success' => true,
        ], 200));
    }
}
