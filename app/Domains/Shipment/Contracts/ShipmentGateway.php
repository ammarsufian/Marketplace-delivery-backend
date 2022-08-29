<?php

namespace App\Domains\Shipment\Contracts;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Log;

class ShipmentGateway
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'verified' => false
        ]);
    }

    public function send()
    {
        try {
            return $this->client->request($this->getMethod(), $this->getUrl(), [
                    'headers' => ['Accept' => 'application/json'],
                    RequestOptions::JSON => $this->getParams(),
                ]
            )->getBody()->getContents();

        } catch (Exception $exception) {
            Log::error('ERROR SHIPMENT' . $exception->getMessage());
            return 'failed';
        }
    }

    public function getMethod()
    {
        throw new Exception('Please make Override for getMethod Function ');
    }

    public function getUrl()
    {
        throw new Exception('Please make Override for getUrl Function ');
    }

    public function getParams()
    {
        throw new Exception('Please make Override for getParams Function ');
    }
}
