<?php

namespace App\Filament\Resources\Forum\TopicCommentResource\Pages;

use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\Forum\TopicCommentResource;

class EditTopicComment extends EditRecord
{
    protected static string $resource = TopicCommentResource::class;
}
