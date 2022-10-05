<?php

namespace App\Domains\AccountManagement\Http\Resources;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class ProviderBranchResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        $user= Auth::user();
        return [
            'id' => $this->id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'brand' => new BrandResource($this->brand),
            'contact_cafe' => [
                'mobile_number' => data_get($this->contact_us, 'mobile_number'),
                'email' => data_get($this->contact_us, 'email')
            ],
             'porvider'=>[
                 'id'=>$user->id,
                 'name'=>$user->name,
                 'email'=>$user->email,
                 'mobile_number'=>$user->mobile_number,
             ],
        ];
    }
}

