<?php

namespace App\Filament\Resources\Forum\TopicResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Forum\TopicResource;

class ListTopics extends ListRecords
{
    protected static string $resource = TopicResource::class;
}
