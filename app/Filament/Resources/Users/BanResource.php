<?php

namespace App\Filament\Resources\Users;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\User\UserBan;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use App\Filament\Resources\Users\BanResource\Pages;

class BanResource extends Resource
{
    protected static ?string $model = UserBan::class;

    protected static ?string $slug = 'users/bans';

    protected static ?string $navigationGroup = 'Usuários';

    protected static ?string $navigationLabel = 'Gerenciar Banimentos';

    protected static ?string $navigationIcon = 'heroicon-o-ban';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(['default' => 0])->schema([
                    Forms\Components\BelongsToSelect::make('user_id')
                        ->label('Usuário')
                        ->relationship('user', 'username')
                        ->placeholder('Usuário')
                        ->disablePlaceholderSelection()
                        ->options(User::pluck('username', 'id'))
                        ->searchable()
                        ->required(),

                    Forms\Components\Select::make('type')
                        ->label('Tipo de Banimento')
                        ->default('account')
                        ->options([
                            'account' => 'Conta',
                            'ip' => 'IP'
                        ])
                        ->required(),

                    Forms\Components\Textarea::make('reason')
                        ->hint('<strong>Padrão:</strong> Sem motivo')
                        ->label('Razão do Banimento'),

                    Forms\Components\DateTimePicker::make('expires_at')
                        ->label('Expiração do Banimento')
                        ->hint('<strong>Padrão:</strong> Permanente')
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBans::route('/'),
            'create' => Pages\CreateBan::route('/create'),
            'view' => Pages\ViewBan::route('/{record}'),
            'edit' => Pages\EditBan::route('/{record}/edit'),
        ];
    }
}
