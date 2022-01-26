<?php

namespace App\Filament\Resources\Articles\ArticleResource\Pages;

use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\Articles\ArticleResource;

class EditArticle extends EditRecord
{
    protected static string $resource = ArticleResource::class;
}
