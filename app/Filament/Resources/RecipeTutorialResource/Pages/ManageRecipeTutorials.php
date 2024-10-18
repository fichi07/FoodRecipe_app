<?php

namespace App\Filament\Resources\RecipeTutorialResource\Pages;

use App\Filament\Resources\RecipeTutorialResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageRecipeTutorials extends ManageRecords
{
    protected static string $resource = RecipeTutorialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
