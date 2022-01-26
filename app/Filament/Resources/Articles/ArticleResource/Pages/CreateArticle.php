<?php

namespace App\Filament\Resources\Articles\ArticleResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\Articles\ArticleResource;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;
}
