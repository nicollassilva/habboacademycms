<?php

namespace App\Filament\Resources\Articles\ArticleCategoryResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Tables\Filters;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms\Components\Grid;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\RelationManagers\HasManyRelationManager;

class ArticlesRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'articles';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(['default' => 0])->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Título')
                        ->placeholder("Título da notícia")
                        ->required(),

                    Forms\Components\TextInput::make('description')
                        ->label('Descrição')
                        ->placeholder("Descrição da notícia")
                        ->required(),

                    Forms\Components\FileUpload::make('image_path')
                        ->label('Imagem')
                        ->directory('articles')
                        ->required()
                        ->helperText('PS: Espere carregar a imagem para salvar a notícia.')
                        ->image(),

                    Forms\Components\RichEditor::make('content')
                        ->label('Conteúdo da Notícia')
                        ->required()
                        ->fileAttachmentsDirectory('articles'),

                    Forms\Components\Toggle::make('fixed')
                        ->hint('<strong>Padrão:</strong> Não fixado')
                        ->label('Fixar notícia')
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->limit(50),

                Tables\Columns\TextColumn::make('user.username')
                    ->label('Autor'),

                Tables\Columns\BooleanColumn::make('fixed')
                    ->label('Fixada')
                    ->trueIcon('heroicon-o-badge-check')
                    ->falseIcon('heroicon-o-x-circle'),

                Tables\Columns\BooleanColumn::make('reviewed')
                    ->label('Revisada')
                    ->trueIcon('heroicon-o-badge-check')
                    ->falseIcon('heroicon-o-x-circle'),

                Tables\Columns\TextColumn::make('status')->enum([
                    '0' => 'Rascunho',
                    '1' => 'Publicada'
                ])
            ])
            ->filters([
                Filters\SelectFilter::make('reviewed')
                    ->label('Revisadas')
                    ->placeholder('Todas')
                    ->options([
                        '0' => 'Rascunho',
                        '1' => 'Publicada'
                    ]),

                Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->placeholder('Todas')
                    ->options([
                        '0' => 'Rascunho',
                        '1' => 'Publicada'
                    ]),

                Filters\SelectFilter::make('user_id')
                    ->placeholder('Todos')
                    ->label('Autor')
                    ->relationship('user', 'username'),

                Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Criado a partir de'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Até'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
            ]);
    }
}
