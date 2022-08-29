<?php

namespace App\Domains\Authentication\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'mobile_number' => $this->mobile_number,
            'is_active' => $this->is_active,
        ];
    }
}
