<?php

namespace App\Domains\ProductManagement\Http\Controllers;

use App\Domains\ProductManagement\Http\Requests\StoreUserFavoriteRequest;
use App\Domains\ProductManagement\Services\FavoriteService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{

    public function store(StoreUserFavoriteRequest $request, FavoriteService $favoriteService)
    {
        return $favoriteService->createUserFavorite($request);
    }

    public function index(Request $request, FavoriteService $favoriteService)
    {
        return $favoriteService->getUserFavorites($request);
    }
}
