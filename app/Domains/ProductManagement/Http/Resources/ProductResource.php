<?php

namespace App\Domains\ProductManagement\Http\Resources;

use App\Domains\ApplicationManagement\Http\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image,
            'category' => CategoryResource::make($this->category),
        ];
    }
}
