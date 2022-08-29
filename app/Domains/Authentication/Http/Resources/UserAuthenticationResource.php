<?php

namespace App\Domains\Authentication\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAuthenticationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
	        'id'=> $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'mobile_number' => $this->mobile_number,
            'access_token' => $this->createToken($request->header('source') ?? 'mobile')->plainTextToken,
            'is_active' => $this->is_active,
        ];
    }
}
