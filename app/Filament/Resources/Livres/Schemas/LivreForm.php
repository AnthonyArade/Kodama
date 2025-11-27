<?php

namespace App\Filament\Resources\Livres\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class LivreForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('category_id')
                    ->required()
                    ->numeric(),
                TextInput::make('nom')
                    ->required(),
                TextInput::make('auteur')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image()
                    ->required(),
                TextInput::make('prix')
                    ->required()
                    ->numeric(),
                DatePicker::make('date_sortie')
                    ->required(),
                TextInput::make('stock')
                    ->required()
                    ->numeric(),
                TextInput::make('like')
                    ->required()
                    ->numeric(),
                TextInput::make('unlike')
                    ->required()
                    ->numeric(),
            ]);
    }
}
