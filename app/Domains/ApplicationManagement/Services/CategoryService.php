<?php

namespace App\Domains\ApplicationManagement\Services;

use App\Domains\ApplicationManagement\Actions\GetCategoriesListAction;
use App\Domains\ApplicationManagement\Http\Resources\CategoryResource;
use Exception;
use Illuminate\Http\Request;

class CategoryService
{
    public function index(Request $request)
    {
        try {
            $results = (new GetCategoriesListAction($request))->execute();
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false
            ], 400);
        }

        return CategoryResource::collection($results);
    }
}
