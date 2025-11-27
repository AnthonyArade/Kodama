<?php

namespace App\Filament\Resources\Livres\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LivreInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('category_id')
                    ->numeric(),
                TextEntry::make('nom'),
                TextEntry::make('auteur'),
                TextEntry::make('description')
                    ->columnSpanFull(),
                ImageEntry::make('image'),
                TextEntry::make('prix')
                    ->numeric(),
                TextEntry::make('date_sortie')
                    ->date(),
                TextEntry::make('stock')
                    ->numeric(),
                TextEntry::make('like')
                    ->numeric(),
                TextEntry::make('unlike')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
