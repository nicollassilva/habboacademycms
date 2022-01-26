<?php

namespace App\Filament\Resources\Users;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Tables\Filters;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Traits\ShowLatestResources;
use App\Filament\Resources\Users\UserResource\Pages;

class UserResource extends Resource
{
    use ShowLatestResources;

    protected static ?string $model = User::class;

    protected static ?string $recordTitleAttribute = 'username';

    protected static ?string $navigationGroup = 'Usuários';

    protected static ?string $navigationLabel = 'Gerenciar Usuários';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(['default' => 0])->schema([
                    Forms\Components\TextInput::make('username')
                        ->label('Usuário')
                        ->minLength(2)
                        ->maxLength(30)
                        ->unique(User::class, 'username', fn ($record) => $record)
                        ->required(),

                    Forms\Components\TextInput::make('name')
                        ->label('Nome Real'),

                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->unique(User::class, 'email', fn ($record) => $record)
                        ->label('Email')
                        ->required(),

                    Forms\Components\FileUpload::make('profile_image_path')
                        ->label('Avatar')
                        ->directory('profiles')
                        ->helperText('PS: Espere carregar a imagem para salvar o usuário.')
                        ->default('profiles/default.png')
                        ->image(),

                    Forms\Components\TextInput::make('topics_comment_count')
                        ->label('Total de Comentários no Fórum')
                        ->numeric()
                        ->disabled(),

                    Forms\Components\Toggle::make('disabled')
                        ->label('Conta desativada')
                        ->helperText('Marque acima para desativar uma conta, é preferível não excluir para não perder os seus dados.'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable(),

                Tables\Columns\ImageColumn::make('profile_image_path')
                    ->label('Avatar')
                    ->rounded(),

                Tables\Columns\TextColumn::make('username')
                    ->label('Usuário')
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Data Registro')
                    ->date('d/m/y \à\s H:i'),

                Tables\Columns\BooleanColumn::make('disabled')
                    ->label('Conta Ativa')
                    ->trueColor('danger')
                    ->falseColor('success')
                    ->trueIcon('heroicon-o-x-circle')
                    ->falseIcon('heroicon-o-badge-check'),
            ])
            ->filters([
                Filters\SelectFilter::make('disabled')
                    ->label('Tipo de Conta')
                    ->placeholder('Todas')
                    ->options([
                        '0' => 'Ativas',
                        '1' => 'Desativadas',
                    ]),

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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function canDelete(Model $model): bool
    {
        return false;
    }
}
