<?php

namespace App\Filament\Resources\Academy;

use Filament\Forms;
use Filament\Tables;
use App\Models\Badge;
use Filament\Tables\Filters;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Traits\ShowLatestResources;
use App\Filament\Resources\Academy\BadgeResource\Pages;

class BadgeResource extends Resource
{
    use ShowLatestResources;

    protected static ?string $model = Badge::class;

    protected static ?string $slug = 'academy/badges';

    protected static ?string $recordTitleAttribute = 'code';

    protected static ?string $navigationGroup = 'Academy';

    protected static ?string $navigationLabel = 'Gerenciar Emblemas';

    protected static ?string $navigationIcon = 'heroicon-o-view-grid';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(['default' => 0])->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Título')
                        ->required(),

                    Forms\Components\TextInput::make('description')
                        ->hint('<strong>Padrão:</strong> Sem descrição')
                        ->label('Descrição'),
                ]),

                Forms\Components\TextInput::make('code')
                    ->label('Código')
                    ->minLength(0)
                    ->maxLength(10)
                    ->required()
                    ->unique(Badge::class, 'code', fn ($record) => $record)
                    ->helperText('Entre 0 e 10 caracteres'),

                Forms\Components\TextInput::make('image_path')
                    ->label('URL da Imagem')
                    ->required(),

                Forms\Components\Select::make('rarity')
                    ->placeholder('Escolha uma raridade')
                    ->required()
                    ->options(Badge::$rarities),

                Forms\Components\TextInput::make('content_slug')
                    ->url()
                    ->hint('<strong>Padrão:</strong> Sem conteúdo relacionado')
                    ->helperText('Coloque apenas URLs internos (do site)')
                    ->label('URL relacionado ao Emblema'),
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
                    ->enum(Badge::$rarities),

                Tables\Columns\TextColumn::make('users_count')
                    ->extraAttributes(['class' => 'font-bold'])
                    ->label('Usuários que possuem')
                    ->counts('users')
            ])
            ->filters([
                Filters\SelectFilter::make('rarity')
                    ->label('Raridade')
                    ->placeholder('Todas')
                    ->options(Badge::$rarities),

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
            BadgeResource\RelationManagers\UsersRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBadges::route('/'),
            'create' => Pages\CreateBadge::route('/create'),
            'edit' => Pages\EditBadge::route('/{record}/edit'),
        ];
    }
}
