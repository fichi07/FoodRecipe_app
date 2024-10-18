<?php

namespace App\Filament\Resources\RecipeIngredientResource\Pages;

use App\Filament\Resources\RecipeIngredientResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageRecipeIngredients extends ManageRecords
{
    protected static string $resource = RecipeIngredientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
