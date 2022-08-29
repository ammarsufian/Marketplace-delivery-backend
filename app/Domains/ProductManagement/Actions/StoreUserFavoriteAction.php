<?php

namespace App\Domains\ProductManagement\Actions;

use App\Domains\Interfaces\Actionable;
use App\Domains\ProductManagement\Http\Requests\StoreUserFavoriteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreUserFavoriteAction implements Actionable
{
    protected Request $request;

    public function __construct(StoreUserFavoriteRequest $request)
    {
        $this->request = $request;
    }

    public function execute()
    {
         $favorite = Auth::user()->favorites()
             ->where('entity_product_id',$this->request->get('entity_product_id'))
             ->first();
         if($favorite)
             return $favorite->delete();
         else
             return Auth::user()->favorites()
                 ->create(['entity_product_id' => $this->request->get('entity_product_id')]);
    }
}
