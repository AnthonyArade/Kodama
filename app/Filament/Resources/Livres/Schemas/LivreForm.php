<?php

namespace App\Filament\Resources\Livres\Schemas;

use App\Models\Category;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;

class LivreForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->required()
                    ->options(
                        Category::query()
                            ->pluck('nom', 'id')
                            ->toArray()
                    )
                    ->label('Category'),
                TextInput::make('nom')
                    ->required(),
                TextInput::make('auteur')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image')
                ->disk('public')
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
