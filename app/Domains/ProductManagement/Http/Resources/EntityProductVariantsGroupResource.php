<?php

namespace App\Domains\ProductManagement\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EntityProductVariantsGroupResource extends JsonResource
{

    public function toArray($request)
    {
        $group = $this->first()->group;
        return [
            'type' => $group->type,
            'is_required' => $group->is_required,
            'maximum_quantity' => $group->maximum_quantity,
            'variants' => EntityProductVariantsResource::collection($this)
        ];
    }
}
