<?php

namespace App\Filament\Resources\Forum\TopicCategoryResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\Forum\TopicCategoryResource;

class CreateTopicCategory extends CreateRecord
{
    protected static string $resource = TopicCategoryResource::class;
}
