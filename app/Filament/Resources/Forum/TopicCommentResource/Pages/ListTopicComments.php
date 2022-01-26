<?php

namespace App\Filament\Resources\Forum\TopicCommentResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Forum\TopicCommentResource;

class ListTopicComments extends ListRecords
{
    protected static string $resource = TopicCommentResource::class;
}
