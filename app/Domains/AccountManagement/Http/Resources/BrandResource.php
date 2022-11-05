<?php

namespace App\Domains\AccountManagement\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->logo,
            'description' => $this->description,
            'country' => $this->country->name,
        ];
    }
}
