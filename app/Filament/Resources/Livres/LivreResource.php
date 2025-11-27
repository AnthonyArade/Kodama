<?php

namespace App\Filament\Resources\Livres;

use App\Filament\Resources\Livres\Pages\CreateLivre;
use App\Filament\Resources\Livres\Pages\EditLivre;
use App\Filament\Resources\Livres\Pages\ListLivres;
use App\Filament\Resources\Livres\Pages\ViewLivre;
use App\Filament\Resources\Livres\Schemas\LivreForm;
use App\Filament\Resources\Livres\Schemas\LivreInfolist;
use App\Filament\Resources\Livres\Tables\LivresTable;
use App\Models\Livre;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LivreResource extends Resource
{
    protected static ?string $model = Livre::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::BookOpen;

    protected static ?string $recordTitleAttribute = 'Livre';

    public static function form(Schema $schema): Schema
    {
        return LivreForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LivreInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LivresTable::configure($table);
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
            'index' => ListLivres::route('/'),
            'create' => CreateLivre::route('/create'),
            'view' => ViewLivre::route('/{record}'),
            'edit' => EditLivre::route('/{record}/edit'),
        ];
    }
}
