<?php

namespace App\Filament\Resources\TopicCategoryResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Tables\Filters;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms\Components\Grid;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\RelationManagers\HasManyRelationManager;

class TopicsRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'topics';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(['default' => 0])->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Título')
                        ->placeholder("Título do tópico")
                        ->required(),

                    Forms\Components\Select::make('moderated')
                        ->label('Situação do Tópico')
                        ->options([
                            'closed' => 'Fechado',
                            'moderated' => 'Moderado',
                            'pending' => 'Pendente',
                        ]),

                    Forms\Components\Toggle::make('fixed')
                        ->label('Fixar tópico'),

                    Forms\Components\Toggle::make('status')
                        ->label('Tópico ativo'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->label('Título')
                    ->limit(50),

                Tables\Columns\TextColumn::make('user.username')
                    ->searchable()
                    ->label('Autor'),

                Tables\Columns\BooleanColumn::make('fixed')
                    ->label('Fixado')
                    ->trueIcon('heroicon-o-badge-check')
                    ->falseIcon('heroicon-o-x-circle'),

                Tables\Columns\BooleanColumn::make('status')
                    ->label('Ativo')
                    ->trueIcon('heroicon-o-badge-check')
                    ->falseIcon('heroicon-o-x-circle'),

                Tables\Columns\TextColumn::make('moderated')
                    ->label('Situação')
                    ->enum([
                        'moderated' => 'Moderado',
                        'pending' => 'Pendente',
                        'closed' => 'Fechado'
                    ])
            ])
            ->filters([
                Filters\SelectFilter::make('moderated')
                    ->label('Situação')
                    ->placeholder('Todas')
                    ->options([
                        'moderated' => 'Moderado',
                        'pending' => 'Pendente',
                        'closed' => 'Fechado'
                    ]),

                Filters\SelectFilter::make('fixed')
                    ->label('Fixados')
                    ->placeholder('Todos')
                    ->options([
                        '0' => 'Não fixados',
                        '1' => 'Fixados',
                    ]),

                Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->placeholder('Todos')
                    ->options([
                        '0' => 'Ocultos',
                        '1' => 'Ativos'
                    ]),

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


    public function canCreate(): bool
    {
        return false;
    }
}
