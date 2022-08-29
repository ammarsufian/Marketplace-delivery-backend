<?php

namespace App\Domains\ProductManagement\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EntityProductVariantsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->pivot->price ?? $this->price
        ];
    }
}
