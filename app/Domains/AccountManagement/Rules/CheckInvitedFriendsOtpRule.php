<?php

namespace App\Domains\AccountManagement\Rules;

use App\Domains\Interfaces\Rulable;
use Illuminate\Support\Facades\Redis;

class CheckInvitedFriendsOtpRule implements Rulable
{
    protected string $mobile_number;
    protected string $otp;
    protected string $sent_otp;

    public function __construct(string $mobile_number, string $otp)
    {
        $this->mobile_number = $mobile_number;
        $this->otp = $otp;
        $this->sent_otp = '1234';//Redis::get($this->mobile_number);
    }

    public function run(): bool
    {
        return !is_null($this->sent_otp) && $this->otp == $this->sent_otp;
    }

    public function getMessage(): string
    {
        return 'invalid OTP'; //TODO::make translate for this
    }
}
