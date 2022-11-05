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
            'status' => (bool) $this->status,
            'contact_cafe' => [
                'mobile_number' => data_get($this->contact_us, 'mobile_number'),
                'email' => data_get($this->contact_us, 'email')
            ],
            'schedule' => $this->schedule,
            'provider' => UserResource::make($this->owners->first()),
            'created_at' => $this->created_at->toDateTimeString(),
            'rate' => 5,
        ];
    }
}

