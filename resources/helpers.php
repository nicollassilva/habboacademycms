<?php

use App\Services\{
    TarjaService,
    TimeService,
    UserCodeService
};

if (! function_exists('dateToString')) {
    /**
     * Turns the date into a friendly date string.
     * 
     * @param \Carbon\Carbon|\Datetime|string $date
     * 
     * @return string
     */
    function dateToString($date): String
    {
        return TimeService::transform($date);
    }
}

if (! function_exists('getTarja')) {
    /**
     * Get the user forum tarja.
     * 
     * @param int $messageCount
     * 
     * @return array
     */
    function getTarja(Int $messageCount): Array
    {
        return TarjaService::make($messageCount);
    }
}

if (! function_exists('renderUserCode')) {
    /**
     * Render the user code.
     * 
     * @param string $userText
     * @param int $renderType
     * 
     * @return string
     */
    function renderUserCode(String $userText, Int $renderType = 1): String
    {
        return UserCodeService::render($userText, $renderType);
    }
}