<?php

namespace App\Filament\Resources\Furni;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use App\Models\Furni\FurniCategory;
use Filament\Forms\Components\Grid;
use App\Filament\Resources\Furni\FurniCategoryResource\Pages;

class FurniCategoryResource extends Resource
{
    protected static ?string $model = FurniCategory::class;

    protected static ?string $slug = 'furni/categories';

    protected static ?string $navigationGroup = 'Valores';

    protected static ?string $navigationLabel = 'Gerenciar Categorias';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(['default' => 0])->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nome')
                        ->required(),

                    Forms\Components\FileUpload::make('icon')
                        ->label('Ícone da Categoria')
                        ->directory('topics_categories')
                        ->hint('<strong>Padrão:</strong> Sem ícone')
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
                    ->label('Ícone')
                    ->size(20),

                Tables\Columns\TextColumn::make('furnis_count')
                    ->label('Contador de Mobis')
                    ->counts('furnis')
                    ->extraAttributes(['class' => 'font-bold'])
            ])
            ->filters([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            FurniCategoryResource\RelationManagers\FurnisRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFurniCategories::route('/'),
            'create' => Pages\CreateFurniCategory::route('/create'),
            'edit' => Pages\EditFurniCategory::route('/{record}/edit'),
        ];
    }
}
