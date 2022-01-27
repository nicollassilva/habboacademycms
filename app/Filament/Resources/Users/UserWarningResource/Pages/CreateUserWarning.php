<?php

namespace App\Filament\Resources\Users\UserWarningResource\Pages;

use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\Users\UserWarningResource;

class CreateUserWarning extends CreateRecord
{
    protected static string $resource = UserWarningResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['admin_id'] = Filament::auth()->user()->id;
    
        return $data;
    }
}
