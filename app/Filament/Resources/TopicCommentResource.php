<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Tables\Filters;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use App\Models\Topic\TopicComment;
use Filament\Forms\Components\Grid;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TopicCommentResource\Pages;
use App\Filament\Resources\TopicCommentResource\RelationManagers;

class TopicCommentResource extends Resource
{
    protected static ?string $model = TopicComment::class;

    protected static ?string $navigationIcon = 'heroicon-o-annotation';

    protected static ?string $navigationGroup = 'Fórum';

    protected static ?string $navigationLabel = 'Gerenciar Comentários';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(['default' => 0])->schema([
                    Forms\Components\Select::make('moderated')
                        ->label('Situação do Comentário')
                        ->options([
                            'moderated' => 'Moderado',
                            'pending' => 'Pendente'
                        ]),

                    Forms\Components\Toggle::make('active')
                        ->label('Comentário ativo')
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->searchable()
                    ->label('ID'),

                Tables\Columns\TextColumn::make('topic.title')
                    ->label('Tópico')
                    ->searchable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('user.username')
                    ->label('Autor')
                    ->searchable()
                    ->limit(20),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Data')
                    ->dateTime('d/m/y \à\s H:i'),

                Tables\Columns\BooleanColumn::make('active')
                    ->label('Ativo')
                    ->trueIcon('heroicon-o-badge-check')
                    ->falseIcon('heroicon-o-x-circle'),

                    Tables\Columns\TextColumn::make('moderated')
                    ->label('Situação')
                    ->searchable()
                    ->enum([
                        'moderated' => 'Moderado',
                        'pending' => 'Pendente'
                    ])
            ])
            ->filters([
                Filters\SelectFilter::make('moderated')
                    ->label('Situação')
                    ->placeholder('Todas')
                    ->options([
                        'moderated' => 'Moderado',
                        'pending' => 'Pendente'
                    ]),

                Filters\SelectFilter::make('active')
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTopicComments::route('/'),
            'view' => Pages\ViewTopicComment::route('/{record}'),
            'edit' => Pages\EditTopicComment::route('/{record}/edit'),
        ];
    }
}
