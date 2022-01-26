<?php

namespace App\Filament\Traits;

use Illuminate\Database\Eloquent\Builder;

trait ShowLatestResources
{
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->latest();
    }
}