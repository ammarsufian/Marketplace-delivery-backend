<?php

namespace App\Domains\ProductManagement\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EntityProductResource extends JsonResource
{

    public function toArray($request): array
    {
        $variants = $this->variants->groupBy('group_id');
        return [
            'id' => $this->id,
            'price' => $this->unit_price,
            'product' => ProductResource::make($this->product),
            'variant_groups' => EntityProductVariantsGroupResource::collection($variants),
            'additional_items' => EntityProductAdditionalItemResource::collection($this->additional),
            'is_favorite' => $this->favorites->isNotEmpty(),
        ];
    }
}
