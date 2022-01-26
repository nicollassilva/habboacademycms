<?php

namespace App\Filament\Resources\Articles;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use App\Models\Article\ArticleCategory;
use App\Filament\Resources\Articles\ArticleCategoryResource\Pages;

class ArticleCategoryResource extends Resource
{
    protected static ?string $model = ArticleCategory::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Notícias';

    protected static ?string $navigationLabel = 'Gerenciar Categorias';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(['default' => 0])->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nome')
                        ->placeholder("Nome da categoria")
                        ->required(),

                    Forms\Components\FileUpload::make('icon')
                        ->label('Imagem')
                        ->directory('articles/categories')
                        ->required()
                        ->helperText('PS: Espere carregar a imagem para salvar a categoria.')
                        ->image(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Nome'),

                Tables\Columns\ImageColumn::make('icon')
                    ->label('Imagem')
                    ->size(20)
            ])
            ->filters([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ArticleCategoryResource\RelationManagers\ArticlesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticleCategories::route('/'),
            'create' => Pages\CreateArticleCategory::route('/create'),
            'view' => Pages\ViewArticleCategory::route('/{record}'),
            'edit' => Pages\EditArticleCategory::route('/{record}/edit'),
        ];
    }
}
