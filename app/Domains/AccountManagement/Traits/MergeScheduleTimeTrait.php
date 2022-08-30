<?php

namespace App\Domains\AccountManagement\Traits;


trait MergeScheduleTimeTrait
{
    public function mergeScheduleTime(array $schedule): array
    {
        $merged = [];
        foreach ($schedule as $day => $times) {
            foreach ($times as $key => $time) {
                $merged[$day][$key] =
                    $time['start'] . "-" . $time['end'];
            }
        }
        return $merged;
    }
}
