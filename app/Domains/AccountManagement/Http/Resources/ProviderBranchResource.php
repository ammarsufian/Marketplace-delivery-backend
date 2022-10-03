<?php

namespace App\Domains\AccountManagement\Http\Resources;


use App\Domains\ApplicationManagement\Http\Resources\CategoryResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProviderBranchResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        $schedule = $this->today_schedule;
        $open_dateTime = Carbon::parse(data_get($schedule, 'open_datetime'));
        $close_dateTime = Carbon::parse(data_get($schedule, 'close_datetime'));

        return [
            'id' => $this->id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'type' => $this->type,
            'brand' => new BrandResource($this->brand),
            'schedule' => $this->schedule,
            'status' => $this->status,
            'delivery_time' => $this->delivery_time,
            'contact_cafe' => [
                'mobile_number' => data_get($this->contact_us, 'mobile_number'),
                'email' => data_get($this->contact_us, 'email')
            ],
            'open_hour' => $open_dateTime->format('h:i A'),
            'close_hour' => $close_dateTime->format('h:i A'),
            'categories' => CategoryResource::collection($this->categories)

        ];
    }
}

