<?php

namespace App\Filament\Resources\Slide;

use Filament\Forms;
use Filament\Tables;
use App\Models\Slide;
use Filament\Resources\Form;
use Filament\Tables\Filters;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use App\Filament\Traits\ShowLatestResources;
use App\Filament\Resources\Slide\SlideResource\Pages;

class SlideResource extends Resource
{
    use ShowLatestResources;

    protected static ?string $model = Slide::class;

    protected static ?string $navigationGroup = 'Academy';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationLabel = 'Gerenciar Slides';

    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-line';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(['default' => 0])->schema([
                    Forms\Components\TextInput::make('title')
                        ->maxLength(255)
                        ->required()
                        ->label('Título'),

                    Forms\Components\TextInput::make('description')
                        ->label('Descrição'),

                    Forms\Components\TextInput::make('slug')
                        ->label('Link para Navegação'),

                    Forms\Components\FileUpload::make('image_path')
                        ->image()
                        ->label('Imagem')
                        ->required(),
                ]),

                Forms\Components\Toggle::make('active')
                    ->label('Ativo')
                    ->helperText('Marque para aparecer no site'),

                Forms\Components\Toggle::make('fixed')
                    ->label('Slide fixo')
                    ->helperText('Sempre aparecerá primeiro dos outros'),

                Forms\Components\Toggle::make('new_tab')
                    ->label('Nova guia')
                    ->helperText('Abrirá o link em uma nova guia')
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
                    ->rounded(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable(),

                Tables\Columns\BooleanColumn::make('active')
                    ->label('Ativo')
                    ->trueIcon('heroicon-o-badge-check')
                    ->falseIcon('heroicon-o-x-circle'),

                Tables\Columns\BooleanColumn::make('fixed')
                    ->label('Fixo')
                    ->trueIcon('heroicon-o-badge-check')
                    ->falseIcon('heroicon-o-x-circle'),
            ])
            ->filters([
                Filters\SelectFilter::make('active')
                    ->label('Ativos')
                    ->placeholder('Todos')
                    ->options([
                        '0' => 'Desativados',
                        '1' => 'Ativos',
                    ]),

                Filters\SelectFilter::make('fixed')
                    ->label('Fixados')
                    ->placeholder('Todos')
                    ->options([
                        '0' => 'Não fixados',
                        '1' => 'Fixados',
                    ]),
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
            'index' => Pages\ListSlides::route('/'),
            'create' => Pages\CreateSlide::route('/create'),
            'view' => Pages\ViewSlide::route('/{record}'),
            'edit' => Pages\EditSlide::route('/{record}/edit'),
        ];
    }
}
