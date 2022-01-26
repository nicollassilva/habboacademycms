<?php

namespace App\Filament\Resources\Articles\ArticleCategoryResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Articles\ArticleCategoryResource;

class ListArticleCategories extends ListRecords
{
    protected static string $resource = ArticleCategoryResource::class;
}
