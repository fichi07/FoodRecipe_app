<?php

namespace App\Filament\Resources\RecipePhotoResource\Pages;

use App\Filament\Resources\RecipePhotoResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageRecipePhotos extends ManageRecords
{
    protected static string $resource = RecipePhotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
