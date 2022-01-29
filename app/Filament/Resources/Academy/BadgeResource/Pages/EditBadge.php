<?php

namespace App\Filament\Resources\Academy\BadgeResource\Pages;

use App\Models\Badge;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\Academy\BadgeResource;

class EditBadge extends EditRecord
{
    protected static string $resource = BadgeResource::class;

    public function label()
    {
        LinkAction::make('edit')
            ->label('Edit badge')
            ->url(fn (Badge $record): string => route('badge.edit', $record));
    }
}
