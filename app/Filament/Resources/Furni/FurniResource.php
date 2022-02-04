<?php

namespace App\Filament\Resources\Furni;

use Filament\Forms;
use Filament\Tables;
use App\Models\FurniValue;
use Filament\Resources\Form;
use Filament\Tables\Filters;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use App\Models\Furni\FurniCategory;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Traits\ShowLatestResources;
use App\Filament\Resources\Furni\FurniResource\Pages;

class FurniResource extends Resource
{
    use ShowLatestResources;

    protected static ?string $model = FurniValue::class;

    protected static ?string $slug = 'furni/values';

    protected static ?string $navigationGroup = 'Mobis';

    protected static ?string $navigationLabel = 'Gerenciar Valores';

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(['default' => 0])->schema([
                    
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nome do item'),

                Forms\Components\BelongsToSelect::make('category_id')
                    ->label('Categoria')
                    ->relationship('category', 'name')
                    ->placeholder('Categoria')
                    ->disablePlaceholderSelection()
                    ->options(FurniCategory::pluck('name', 'id'))
                    ->searchable()
                    ->required(),

                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->hint('<strong>Padrão:</strong> Sem preço')
                    ->label('Preço'),

                Forms\Components\Select::make('price_type')
                    ->label('Tipo de Moeda')
                    ->helperText('Especifique qual tipo de moeda é cobrada por esse item nas negociações')
                    ->hint('<strong>Padrão:</strong> Moedas')
                    ->default('coins')
                    ->options([
                        'coins' => 'Moedas',
                        'diamonds' => 'Diamantes',
                        'duckets' => 'Duckets'
                    ])
                    ->disablePlaceholderSelection(),

                Forms\Components\Select::make('state')
                    ->label('Estado do Preço')
                    ->helperText('Especifique se o preço caiu, subiu ou manteve de acordo com o último valor')
                    ->hint('<strong>Padrão:</strong> Manteve')
                    ->default('regular')
                    ->disabled(fn ($livewire) => $livewire instanceof CreateRecord)
                    ->options([
                        'up' => 'Subiu',
                        'down' => 'Caiu',
                        'regular' => 'Manteve'
                    ])
                    ->disablePlaceholderSelection(),
                ]),

                Forms\Components\FileUpload::make('icon_path')
                    ->label('Ícone do Mobi')
                    ->hint('<strong>Padrão:</strong> Não terá ícone')
                    ->directory('values/icons')
                    ->helperText('O ícone aparecerá na listagem da página inicial.')
                    ->image(),

                Forms\Components\FileUpload::make('image_path')
                    ->label('Imagem Original do Mobi')
                    ->directory('values')
                    ->required()
                    ->helperText('PS: Espere carregar a imagem para salvar o valor.')
                    ->image(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable(),

                Tables\Columns\ImageColumn::make('icon_path')
                    ->label('Ícone'),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Nome do Mobi')
                    ->limit(15),

                Tables\Columns\TextColumn::make('price')
                    ->searchable()
                    ->label('Preço')
                    ->formatStateUsing(fn (string $state, $record) => "$state {$record->price_type}"),

                Tables\Columns\TextColumn::make('state')
                    ->label('Estado do Preço')
                    ->enum([
                        'up' => 'Subiu',
                        'down' => 'Caiu',
                        'regular' => 'Manteve'
                    ])
            ])
            ->filters([
                Filters\SelectFilter::make('state')
                    ->label('Estado do Preço')
                    ->placeholder('Todos')
                    ->options([
                        'up' => 'Subiu',
                        'down' => 'Caiu',
                        'regul
                        ar' => 'Manteve'
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
            'index' => Pages\ListFurnis::route('/'),
            'create' => Pages\CreateFurni::route('/create'),
            'edit' => Pages\EditFurni::route('/{record}/edit'),
        ];
    }
}
