<?php

namespace App\Services;

abstract class AcademyService
{
    public static function getUserAccounts(string $ip): int
    {
        return User::where('ip_register', $ip)->count();
    }
}