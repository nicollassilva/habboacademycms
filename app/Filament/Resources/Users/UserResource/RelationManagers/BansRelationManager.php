<?php

namespace App\Filament\Resources\Users\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Facades\Filament;
use Filament\Forms\Components\Grid;
use Filament\Resources\RelationManagers\HasManyRelationManager;

class BansRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'bans';

    protected static ?string $recordTitleAttribute = 'type';

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
                    Forms\Components\Select::make('type')
                        ->label('Tipo de Banimento')
                        ->default('account')
                        ->options([
                            'account' => 'Conta',
                            'ip' => 'IP'
                        ])
                        ->required(),

                    Forms\Components\Textarea::make('reason')
                        ->label('Razão do Banimento'),

                    Forms\Components\DateTimePicker::make('expires_at')
                        ->label('Expiração do Banimento')
                        ->displayFormat('d/m/y H:i')
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
                    ->label('Banido por')
                    ->limit(20),

                Tables\Columns\TextColumn::make('type')
                    ->searchable()
                    ->label('Tipo')
                    ->enum([
                        'ip' => 'IP',
                        'account' => 'Conta'
                    ]),

                Tables\Columns\TextColumn::make('expires_at')
                    ->label('Acaba em')
                    ->date('d/m/y \à\s H:i'),
            ])
            ->filters([]);
    }
}
