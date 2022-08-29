<?php

namespace App\Domains\ProductManagement\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EntityProductAdditionalItemResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'id' => $this->id,
            'price' => $this->pivot->price
        ];
    }
}
