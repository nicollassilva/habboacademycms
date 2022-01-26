<?php

namespace App\Filament\Resources\Forum;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use App\Models\Topic\TopicCategory;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use App\Filament\Resources\Forum\TopicCategoryResource\Pages;

class TopicCategoryResource extends Resource
{
    protected static ?string $model = TopicCategory::class;

    protected static ?string $navigationGroup = 'Fórum';

    protected static ?string $navigationLabel = 'Gerenciar Categorias';

    protected static ?int $navigationSort = 4;

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
                        ->directory('topics_categories')
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
            TopicCategoryResource\RelationManagers\TopicsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTopicCategories::route('/'),
            'create' => Pages\CreateTopicCategory::route('/create'),
            'view' => Pages\ViewTopicCategory::route('/{record}'),
            'edit' => Pages\EditTopicCategory::route('/{record}/edit'),
        ];
    }
}
