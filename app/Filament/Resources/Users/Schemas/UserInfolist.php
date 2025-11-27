<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                ->label('Nom'),
                TextEntry::make('email')
                    ->label('Email'),
                TextEntry::make('email_verified_at')
                    ->dateTime()
                    ->label('Date de verification')
                    ->placeholder('-'),
                IconEntry::make('is_admin')
                ->label('Admin')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->label('Date de création')
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->label('Date de mise a jour')
                    ->placeholder('-'),
            ]);
    }
}
