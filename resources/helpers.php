<?php

use App\Services\{
    ForumLevelService,
    TimeService,
    UserCodeService
};
use App\Models\User;
use App\Models\Badge;
use App\Models\Academy\Navigation;

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

if (! function_exists('getForumLevel')) {
    /**
     * Get the user forum level.
     * 
     * @param int $messageCount
     * 
     * @return array
     */
    function getForumLevel(int $messageCount): Array
    {
        return ForumLevelService::make($messageCount);
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
    function renderUserCode(?string $userText, int $renderType = 1): String
    {
        return UserCodeService::render($userText, $renderType);
    }
}

if (! function_exists('lastUsers')) {
    /**
     * Returns the latest registered users.
     * 
     * @param string $userText
     * @param int $renderType
     * 
     * @return string
     */
    function lastUsers()
    {
        return User::latest()->limit(10)->get();
    }
}

if (! function_exists('getAvatar')) {
    /**
     * Returns the avatar image
     * 
     * @param string $userText
     * @param int $renderType
     * 
     * @return string
     */
    function getAvatar(string $username, string $queryParams)
    {
        $defaultImagerUrl = config('academy.site.defaultImagerUrl');

        return "{$defaultImagerUrl}{$username}{$queryParams}";
    }
}

if (! function_exists('getNavigations')) {
    /**
     * Returns the website navigations
     * 
     * @param bool $subNavigations
     * 
     * @return \App\Models\Academy\Navigation|array
     */
    function getNavigations(bool $subNavigations = true)
    {
        return Navigation::getAcademyNavigation($subNavigations);
    }
}

if (! function_exists('getLastBadges')) {
    /**
     * Returns the latest website badges
     * 
     * @return \App\Models\Badge|array
     */
    function getLastBadges()
    {
        return Badge::latest()->limit(9)->get();
    }
}