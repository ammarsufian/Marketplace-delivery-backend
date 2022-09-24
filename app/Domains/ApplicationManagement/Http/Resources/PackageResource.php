<?php

namespace App\Domains\ApplicationManagement\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'covered_order_counts' => $this->covered_order_counts,
            'covered_month_counts' => $this->covered_month_counts,
            'price' => $this->price,
        ];
    }
}
