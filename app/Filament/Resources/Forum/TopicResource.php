<?php

namespace App\Filament\Resources\Forum;

use Filament\Forms;
use Filament\Tables;
use App\Models\Topic;
use Filament\Resources\Form;
use Filament\Tables\Filters;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use App\Models\Topic\TopicCategory;
use Filament\Forms\Components\Grid;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\Forum\TopicResource\Pages;

class TopicResource extends Resource
{
    protected static ?string $model = Topic::class;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationGroup = 'Fórum';

    protected static ?string $navigationLabel = 'Gerenciar Tópicos';

    protected static ?string $navigationIcon = 'heroicon-o-chat-alt-2';

    protected static ?int $navigationSort = 3;

    protected $queryString = [
        'tableSearchQuery' => ['except' => ''],
    ];

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(['default' => 0])->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Título')
                        ->placeholder("Título do tópico")
                        ->required(),

                    Forms\Components\BelongsToSelect::make('category_id')
                        ->label('Categoria')
                        ->relationship('category', 'name')
                        ->options(TopicCategory::pluck('name', 'id'))
                        ->searchable(),

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
                    ->label('Autor')
                    ->limit(20),

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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTopics::route('/'),
            'view' => Pages\ViewTopic::route('/{record}'),
            'edit' => Pages\EditTopic::route('/{record}/edit'),
        ];
    }
}
