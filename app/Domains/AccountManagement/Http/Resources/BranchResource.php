<?php

namespace App\Domains\AccountManagement\Http\Resources;


use App\Domains\ApplicationManagement\Http\Resources\CategoryResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchResource extends JsonResource
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
        $delivery_data = $this->delivery_data;
        return [
            'id' => $this->id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'open_hour' => $open_dateTime->format('h:i A'),
            'close_hour' => $close_dateTime->format('h:i A'),
            'brand' => new BrandResource($this->brand),
            'is_closed' => $this->checkIfBranchIsClosed($schedule),
            'distance' => (int)$this->distance,
            'delivery_time' => data_get($delivery_data,'duration') ?? $this->delivery_time,
            'delivery_fee' => data_get($delivery_data,'distance'),
            'rating' => 5,//TODO:: To be calculate this from orders
            'contact_cafe' => [
                'mobile_number' => data_get($this->contact_us, 'mobile_number'),
                'email' => data_get($this->contact_us, 'email')
            ],
            'categories' => CategoryResource::collection($this->categories)
        ];
    }

    protected function checkIfBranchIsClosed(array $schedule): bool
    {
        $active_datetime = Carbon::now();
        $close_datetime = data_get($schedule, 'close_datetime') < data_get($schedule, 'open_datetime') ?
            data_get($schedule, 'close_datetime')->addDay() : data_get($schedule, 'close_datetime');

        if ($active_datetime <= $close_datetime && data_get($schedule, 'open_datetime') >= $active_datetime)
            return true;
        return false;
    }
}
