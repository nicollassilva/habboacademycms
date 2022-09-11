<?php

namespace App\Filament\Resources\Academy;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use App\Models\Academy\Navigation;
use Filament\Forms\Components\Grid;
use App\Filament\Resources\Academy\NavigationResource\Pages;

class NavigationResource extends Resource
{
    protected static ?string $model = Navigation::class;

    protected static ?string $slug = 'academy/navigations';

    protected static ?string $recordTitleAttribute = 'label';

    protected static ?string $navigationGroup = 'Academy';

    protected static ?string $navigationLabel = 'Gerenciar Menus';

    protected static ?string $navigationIcon = 'heroicon-o-menu';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(['default' => 0])->schema([
                    Forms\Components\TextInput::make('label')
                        ->label('Label do Menu')
                        ->required(),
                ]),

                Forms\Components\TextInput::make('hover_icon')
                    ->label('Ícone ao passar o mouse')
                    ->url()
                    ->hint('<strong>Padrão:</strong> Não terá ícone ao passar o mouse')
                    ->helperText('Digite a URL da imagem'),

                Forms\Components\TextInput::make('slug')
                    ->hint('<strong>Padrão:</strong> Não terá redirecionamento')
                    ->label('URL de redirecionamento')
                    ->url(),

                Forms\Components\TextInput::make('order')
                    ->numeric()
                    ->hint('<strong>Padrão:</strong> 0 - Ficará entre os primeiros (em ordem alfabética)')
                    ->label('Ordem de exibição (0 a 6)'),

                Forms\Components\Toggle::make('visible')
                    ->hint('<strong>Padrão:</strong> Visível')
                    ->label('Visível no site'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable(),

                Tables\Columns\ImageColumn::make('hover_icon')
                    ->label('Imagem (hover)'),

                Tables\Columns\TextColumn::make('label')
                    ->searchable()
                    ->label('Label')
                    ->limit(15),

                Tables\Columns\TextColumn::make('order')
                    ->searchable()
                    ->sortable()
                    ->label('Ordem de Exibição'),

                Tables\Columns\BooleanColumn::make('visible')
                    ->label('Visível')
                    ->trueIcon('heroicon-o-badge-check')
                    ->falseIcon('heroicon-o-x-circle')
            ])
            ->filters([]);
    }

    public static function getRelations(): array
    {
        return [
            NavigationResource\RelationManagers\SubNavigationsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNavigations::route('/'),
            'create' => Pages\CreateNavigation::route('/create'),
            'edit' => Pages\EditNavigation::route('/{record}/edit'),
        ];
    }
}
