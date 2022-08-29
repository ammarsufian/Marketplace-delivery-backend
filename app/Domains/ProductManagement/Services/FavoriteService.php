<?php

namespace App\Domains\ProductManagement\Services;

use App\Domains\ProductManagement\Actions\ListUserFavoriteAction;
use App\Domains\ProductManagement\Actions\StoreUserFavoriteAction;
use App\Domains\ProductManagement\Http\Requests\StoreUserFavoriteRequest;
use App\Domains\ProductManagement\Http\Resources\EntityProductResource;
use Illuminate\Http\Request;

class FavoriteService
{

    public function createUserFavorite(StoreUserFavoriteRequest $request)
    {
        try {
            (new StoreUserFavoriteAction($request))->execute();
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false
            ], 400);
        }

        return response()->json([
            'message' => 'Success',
            'success' => true
        ]);
    }

    public function getUserFavorites(Request $request)
    {
        try {
            $results = (new ListUserFavoriteAction($request))->execute();
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false
            ], 400);
        }
        return EntityProductResource::collection($results->pluck('entityProduct'));
    }
}
