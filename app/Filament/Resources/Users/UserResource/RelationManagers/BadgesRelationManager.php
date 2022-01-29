<?php

namespace App\Filament\Resources\Users\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Badge;
use Filament\Tables\Filters;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\RelationManagers\BelongsToManyRelationManager;

class BadgesRelationManager extends BelongsToManyRelationManager
{
    protected static string $relationship = 'badges';

    protected static ?string $recordTitleAttribute = 'code';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable(),

                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Imagem')
                    ->size(30),

                Tables\Columns\TextColumn::make('code')
                    ->searchable()
                    ->label('Ordem de Exibição'),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->label('Título')
                    ->limit(15),

                Tables\Columns\TextColumn::make('rarity')
                    ->enum(Badge::$rarities)
            ])
            ->filters([
                Filters\SelectFilter::make('rarity')
                    ->label('Raridade')
                    ->placeholder('Todas')
                    ->options(Badge::$rarities)
            ]);
    }

    public function canCreate(): bool
    {
        return false;
    }

    public function canDelete(Model $record): bool
    {
        return false;
    }

    public function canEdit(Model $record): bool
    {
        return false;
    }

    public function canDeleteAny(): bool
    {
        return false;
    }
}
