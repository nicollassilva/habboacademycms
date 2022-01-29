<?php

namespace App\Services;

use Illuminate\Support\Facades\App;

abstract class AcademyService
{
    public static function getUserAccounts(string $ip): int
    {
        return User::where('ip_register', $ip)->count();
    }

    public static function isProductionEnvironment()
    {
        return App::environment('production');
    }

    public static function isDevEnvironment()
    {
        return App::environment('local');
    }
}