<?php

namespace App\Domains\OrderManagement\Http\Resources;

use App\Domains\ProductManagement\Http\Resources\EntityProductVariantsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'quantity' => $this->quantity,
            'buyable' => BuyableResource::make($this->buyable),
            'variants' => EntityProductVariantsResource::collection($this->variants),
            'subtotal' => $this->sub_total,
            'total' => $this->sub_total,
        ];
    }
}
