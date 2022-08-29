<?php

namespace App\Domains\Shipment\Services;

use GuzzleHttp\Client;
use function App\Helpers\activeAddress;

class ShipmentService
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client(['verified' => 'false']);
    }

    public function getDistanceByGoogle(array $source): array
    {
        $distance = 1;
        $duration = 0;
        $address = activeAddress();
        try {
            $response = $this->client->request('GET', config('shipment.google.distance.url') . '?origin=' . implode(',', $source)
                . '&destination=' . $address->latitude . ',' . $address->longitude .
                '&key=' . config('shipment.google.api-key'));


            collect(json_decode($response->getBody()->getContents()))->map(function ($route) use (&$distance, &$duration) {
                collect($route->legs)->map(function ($leg) use (&$distance, &$duration) {
                    $distance += $leg->distance->value; //values per meter
                    $duration += $leg->duration->value; //values per seconds
                });
            });

        } catch (\Exception $exception) {
            info('ERROR:' . $exception->getMessage());
        }

        if ($distance / 1000 < 1) {
            $distance = 1;
        }

        return [
            'distance' => $distance,
            'duration' => $duration / 60,
            'cost' => round($distance * config('shipment.cova.prices.fast_delivery_kilo_meter'), 3)
        ];
    }
}
