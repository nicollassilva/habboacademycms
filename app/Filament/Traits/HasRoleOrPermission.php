<?php

namespace App\Filament\Traits;

use Filament\Facades\Filament;

trait HasRoleOrPermission
{
    public static function getResourceName()
    {
        return \Str::of(static::class)
            ->between('Resources\\', 'Resource')
            ->lower()
            ->explode('\\')[1];    
    }

    public static function canViewAny(): bool
    {
        $resourceName = static::getResourceName();

        return Filament::auth()->user()->can("view_any_{$resourceName}");
    }
}