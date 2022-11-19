<?php

namespace App\Domains\AccountManagement\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redis;

class SmsService
{
    protected Client $client;
    protected string $url;

    public function __construct()
    {
        $this->client = new Client([
            'verified' => false
        ]);
        $this->url = "http://5.32.122.146:8080/websmpp/websms";
    }

    public function sendOTP(string $mobile_number)
    {
        $otp = mt_rand(111111, 888888);
        $attributes = [
            'user' => 'Cova',
            'pass' => 'Cov1913',
            'sid' => 'COVA APP-AD',//cova
            'mno' => $mobile_number,
            'type' => 1,
            'text' => 'Your registration Otp is : ' . $otp
        ];
        Redis::set($mobile_number, $otp);

        $response = $this->client->get($this->url . '?' . http_build_query($attributes), [
            'accept' => 'application/json'
        ]);

        return true;
    }
}
