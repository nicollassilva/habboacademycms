<?php

namespace App\Filament\Resources\Articles;

use Filament\Forms;
use Filament\Tables;
use App\Models\Article;
use Filament\Tables\Filters;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use App\Models\Article\ArticleCategory;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\Articles\ArticleResource\Pages;
use App\Filament\Traits\ShowLatestResources;

class ArticleResource extends Resource
{
    use ShowLatestResources;
    
    protected static ?string $model = Article::class;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationGroup = 'Notícias';

    protected static ?string $navigationLabel = 'Gerenciar Notícias';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(['default' => 0])->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Título')
                        ->placeholder("Título da notícia")
                        ->required(),

                    Forms\Components\TextInput::make('description')
                        ->label('Descrição')
                        ->placeholder("Descrição da notícia")
                        ->required(),

                    Forms\Components\BelongsToSelect::make('category_id')
                            ->label('Categoria')
                            ->relationship('category', 'name')
                            ->options(ArticleCategory::pluck('name', 'id'))
                            ->searchable(),

                    Forms\Components\FileUpload::make('image_path')
                        ->label('Imagem')
                        ->directory('articles')
                        ->required()
                        ->helperText('PS: Espere carregar a imagem para salvar a notícia.')
                        ->image(),

                    Forms\Components\RichEditor::make('content')
                        ->label('Conteúdo da Notícia')
                        ->required()
                        ->fileAttachmentsDirectory('articles'),

                    Forms\Components\Toggle::make('fixed')
                        ->label('Fixar notícia')
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

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->label('Título')
                    ->limit(50),

                Tables\Columns\TextColumn::make('user.username')
                    ->searchable()
                    ->label('Autor')
                    ->limit(20),

                Tables\Columns\BooleanColumn::make('fixed')
                    ->label('Fixada')
                    ->trueIcon('heroicon-o-badge-check')
                    ->falseIcon('heroicon-o-x-circle'),

                Tables\Columns\BooleanColumn::make('reviewed')
                    ->label('Revisada')
                    ->trueIcon('heroicon-o-badge-check')
                    ->falseIcon('heroicon-o-x-circle'),

                Tables\Columns\TextColumn::make('status')->enum([
                    '0' => 'Rascunho',
                    '1' => 'Publicada'
                ])
            ])
            ->filters([
                Filters\SelectFilter::make('reviewed')
                    ->label('Revisadas')
                    ->placeholder('Todas')
                    ->options([
                        '0' => 'Rascunho',
                        '1' => 'Publicada'
                    ]),

                Filters\SelectFilter::make('fixed')
                    ->label('Fixadas')
                    ->placeholder('Todas')
                    ->options([
                        '0' => 'Não fixadas',
                        '1' => 'Fixadas'
                    ]),

                Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->placeholder('Todas')
                    ->options([
                        '0' => 'Rascunho',
                        '1' => 'Publicada'
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'view' => Pages\ViewArticle::route('/{record}'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
