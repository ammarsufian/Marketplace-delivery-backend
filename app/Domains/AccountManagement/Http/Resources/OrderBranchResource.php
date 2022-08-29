<?php

namespace App\Domains\AccountManagement\Http\Resources;


use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderBranchResource extends JsonResource
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
            'open_hour' => $open_dateTime->format('h:i A'),
            'close_hour' => $close_dateTime->format('h:i A'),
            'brand' => new BrandResource($this->brand),
            'is_closed' => $this->checkIfBranchIsClosed($schedule),
            'rating' => 5, //TODO:: To be calculate this from orders
            'contact_cafe' => [
                'mobile_number' => data_get($this->contact_us, 'mobile_number'),
                'email' => data_get($this->contact_us, 'email')
            ],
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
