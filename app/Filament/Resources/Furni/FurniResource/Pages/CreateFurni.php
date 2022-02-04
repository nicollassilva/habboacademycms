<?php

namespace App\Filament\Resources\Furni\FurniResource\Pages;

use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\Furni\FurniResource;

class CreateFurni extends CreateRecord
{
    protected static string $resource = FurniResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['admin_id'] = Filament::auth()->user()->id;
    
        return $data;
    }
}
