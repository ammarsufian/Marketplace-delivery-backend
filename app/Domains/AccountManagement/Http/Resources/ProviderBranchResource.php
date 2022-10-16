<?php

namespace App\Domains\AccountManagement\Http\Resources;

use App\Domains\Authentication\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProviderBranchResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'brand' => new BrandResource($this->brand),
            'status' => $this->status,
            'contact_cafe' => [
                'mobile_number' => data_get($this->contact_us, 'mobile_number'),
                'email' => data_get($this->contact_us, 'email')
            ],
            'provider' => UserResource::make($this->owners->first())
        ];
    }
}

