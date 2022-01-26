<?php

namespace App\Filament\Resources\Articles\ArticleCategoryResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\Articles\ArticleCategoryResource;

class CreateArticleCategory extends CreateRecord
{
    protected static string $resource = ArticleCategoryResource::class;
}
