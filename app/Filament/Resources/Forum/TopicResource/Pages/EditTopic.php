<?php

namespace App\Filament\Resources\Forum\TopicResource\Pages;

use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\Forum\TopicResource;

class EditTopic extends EditRecord
{
    protected static string $resource = TopicResource::class;
}
