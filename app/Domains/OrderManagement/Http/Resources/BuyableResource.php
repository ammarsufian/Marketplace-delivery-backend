<?php

namespace App\Domains\OrderManagement\Http\Resources;

use App\Domains\ProductManagement\Models\EntityProduct;
use Illuminate\Http\Resources\Json\JsonResource;

class BuyableResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->product->name,
            'price' => $this->unit_price,
            'image' => $this->product->image,
        ];
    }
}
