<?php

namespace App\Filament\Resources\Livres\Pages;

use App\Filament\Resources\Livres\LivreResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewLivre extends ViewRecord
{
    protected static string $resource = LivreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
