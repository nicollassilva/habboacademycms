<?php

namespace App\Filament\Resources\Articles\ArticleResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Articles\ArticleResource;

class ListArticles extends ListRecords
{
    protected static string $resource = ArticleResource::class;
}
