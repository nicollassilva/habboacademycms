<?php

namespace App\Filament\Resources\Users\BanResource\Pages;

use App\Filament\Resources\Users\BanResource;
use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;

class CreateBan extends CreateRecord
{
    protected static string $resource = BanResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['admin_id'] = Filament::auth()->user()->id;
    
        return $data;
    }
}
