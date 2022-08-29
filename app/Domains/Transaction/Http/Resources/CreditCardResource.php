<?php

namespace App\Domains\Transaction\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CreditCardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request):array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'number' => $this->last_digits,
            'expiration_date' => $this->expiration_date,
            'cvv' => $this->cvv,
            'company' => CompanyResource::make($this->company),
        ];
    }
}
