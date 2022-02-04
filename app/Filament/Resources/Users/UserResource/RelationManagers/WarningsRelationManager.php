<?php

namespace App\Filament\Resources\Users\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Tables\Filters;
use Filament\Resources\Table;
use Filament\Facades\Filament;
use Filament\Forms\Components\Grid;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\RelationManagers\HasManyRelationManager;

class WarningsRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'warnings';

    protected static ?string $recordTitleAttribute = 'id';

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['admin_id'] = Filament::auth()->user()->id;
    
        return $data;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(['default' => 0])->schema([
                    Forms\Components\Textarea::make('reason')
                        ->hint('<strong>Padrão:</strong> Vazio')
                        ->label('Razão da Advertência'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.username')
                    ->searchable()
                    ->label('Usuário')
                    ->limit(20),

                Tables\Columns\TextColumn::make('admin.username')
                    ->searchable()
                    ->label('Advertido por')
                    ->limit(20),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Advertido em')
                    ->date('d/m/y \à\s H:i'),
            ])
            ->filters([
                Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Criadas a partir de'),
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
