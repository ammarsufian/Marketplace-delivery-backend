<?php

namespace App\Domains\AccountManagement\Services;

use Exception;
use Illuminate\Http\Request;
use App\Domains\AccountManagement\Actions\CreateContactUsAction;

class ContactUsService
{

    public function create(Request $request){
        try {
            $results = (new CreateContactUsAction($request))->execute();
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
