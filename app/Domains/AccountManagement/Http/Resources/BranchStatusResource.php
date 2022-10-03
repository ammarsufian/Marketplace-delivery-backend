<?php

namespace App\Domains\AccountManagement\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BranchStatusResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {

        return [
            'status' => $this->status,
        ];

    }
}

