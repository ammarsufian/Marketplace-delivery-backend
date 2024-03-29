<?php


return [

    'sender' => [
        'base_url' => env('SENDER_BASE_URL', 'https://sender.sa'),
        'provider_id' => env('SENDER_PROVIDER_ID', 400),
        'api_key' => env('SENDER_API_KEY', 'defs0CvOsyLDHbfHxjYlvhM64M64TTibdO6HYKOr0OsjUcxnii8EWb9bdrvSE5TeUgW0QvFa6YI'),
        'endpoints' => [
            'place_order' => env('SENDER_PLACE_ORDER', '/last-sender/public/api/v1/create-order'),
            'get_order' => env('GET_ORDER_DETAILS', '/last-sender/public/api/v1/order-details/')
        ]
    ]
];
