<?php

namespace App\Filament\Resources\Commandes\RelationManagers;

use Filament\Tables\Table;
use Filament\Actions\CreateAction;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\Commandes\CommandeResource;
use Filament\Resources\RelationManagers\RelationManager;

class LigneRelationManager extends RelationManager
{
    protected static string $relationship = 'ligne';

    protected static ?string $relatedResource = CommandeResource::class;

public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('livre.nom')
                ->label('Nom du livre'),
                TextColumn::make('quantite'),
                TextColumn::make('livre.prix')
                ->label('Prix'),
            ])
            ->actions([
            ]);
    }
}
