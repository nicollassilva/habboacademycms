<?php

namespace App\Filament\Resources\Forum\TopicCategoryResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Forum\TopicCategoryResource;

class ListTopicCategories extends ListRecords
{
    protected static string $resource = TopicCategoryResource::class;
}
