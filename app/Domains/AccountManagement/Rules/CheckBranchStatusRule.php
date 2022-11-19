<?php

namespace App\Domains\AccountManagement\Rules;

use App\Domains\AccountManagement\Models\Branch;
use App\Domains\Interfaces\Rulable;
use Carbon\Carbon;

class CheckBranchStatusRule implements Rulable
{

    protected Branch $branch;

    public function __construct(Branch $branch)
    {
        $this->branch = $branch;
        $this->schedule = $this->branch->today_schedule;
    }

    public function run(): bool
    {
        $active_datetime = Carbon::now();
        $close_datetime = data_get($this->schedule, 'close_datetime') < data_get($this->schedule, 'open_datetime') ?
            data_get($this->schedule, 'close_datetime')->addDay() : data_get($this->schedule, 'close_datetime');

       return $active_datetime <= $close_datetime && data_get($this->schedule, 'open_datetime') >= $active_datetime && $this->branch->status;
    }

    public function getMessage(): string
    {
        return 'Branch is busy ,please try again';//TODO::translate this message
    }
}
