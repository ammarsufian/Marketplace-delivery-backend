<?php

namespace App\Domains\AccountManagement\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAddressResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'is_default' => $this->is_default,
            'type' => $this->type,
            'details' => $this->details,
        ];
    }
}
