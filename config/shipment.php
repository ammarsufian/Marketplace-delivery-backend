<?php

return [
    'google'=>[
        'api-key' =>'AIzaSyD1jB0Hmtp8t8Pyy0Uf-pCvnBj7McS3dEU',
        'distance'=>[
            'url' => env('GOOGLE_DISTANCE_URL','https://maps.googleapis.com/maps/api/directions/json'),
        ]
    ],
    'cova' => [
        'prices'=>[
            'fast_delivery_kilo_meter' => env('FAST_KILO_METER_PRICE',17)
        ]
    ]
];
