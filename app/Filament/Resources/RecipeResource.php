<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RecipeResource\Pages;
use App\Filament\Resources\RecipeResource\RelationManagers;
use App\Models\Recipe;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RecipeResource extends Resource
{
    protected static ?string $model = Recipe::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->helperText('Input nama kategori')
                    ->afterStateUpdated(fn(Set $set, ?String $state) => $set('slug', Str::slug($state)))
                    ->live(debounce: 1000)
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->disabled()
                    ->required(),
                Forms\Components\FileUpload::make('thumbnail')
                    ->image()
                    ->openable()
                    ->required()->directory('thumbnail')
                    ->appendFiles(),
                Forms\Components\Textarea::make('about')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Select::make('category_id')
                    ->relationship('categorie', 'name')
                    ->required(),
                Forms\Components\Select::make('recipe_author_id')
                    ->relationship('recipe_author', 'name')
                    ->required(),
                Forms\Components\TextInput::make('url_video')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('url_file')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->searchable(),
                Tables\Columns\TextColumn::make('categorie.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('recipe_author.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('url_video')
                    ->searchable(),
                Tables\Columns\TextColumn::make('url_file')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageRecipes::route('/'),
        ];
    }
}
