<?php

use App\Services\TimeService;

if (! function_exists('dateToString')) {
    function dateToString($date)
    {
        return TimeService::transform($date);
    }
}