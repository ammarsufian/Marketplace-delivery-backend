<?php

namespace App\Domains\OrderManagement\Http\Resources;

use App\Domains\AccountManagement\Http\Resources\BranchResource;
use App\Domains\AccountManagement\Http\Resources\UserAddressResource;
use App\Domains\OrderManagement\Models\OrderItem;
use App\Domains\Transaction\Http\Resources\TransactionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailsResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'driver' => [
                'name' => 'cova',
                'mobile_number' => '+966331222344'
            ],
            'address' => UserAddressResource::make($this->address),
            'items' => OrderItemsResource::collection($this->items),
            'branch' => BranchResource::make($this->branch),
            'sub_total' => $this->subtotal,
            'total' => $this->total,
            'delivery' => $this->delivery,
            'transaction' => TransactionResource::make($this->transaction),
            'created_at' => $this->created_at->toDateTimeString()
        ];
    }
}
