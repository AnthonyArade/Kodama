<?php

namespace App\Filament\Resources\Commandes\RelationManagers;

use Filament\Tables\Table;
use Filament\Actions\CreateAction;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\Commandes\CommandeResource;
use Filament\Resources\RelationManagers\RelationManager;

/**
 * LigneRelationManager
 * 
 * Ce RelationManager gère l'affichage des lignes de commande associées
 * à une commande dans Filament.
 * 
 * Fonctionnalités :
 * - Définit la relation 'ligne' qui sera utilisée pour récupérer les lignes de commande.
 * - Associe éventuellement un Resource parent lié pour permettre la navigation vers la ressource Commande.
 * - Configure les colonnes à afficher dans le tableau des lignes de commande.
 */
class LigneRelationManager extends RelationManager
{
    /**
     * $relationship
     * 
     * Définit le nom de la relation Eloquent sur le modèle parent (Commande)
     * que ce RelationManager va gérer. Ici, 'ligne' correspond à la relation
     * définie dans le modèle Commande pour récupérer les LigneDeCommande.
     */
    protected static string $relationship = 'ligne';

    /**
     * $relatedResource
     * 
     * Optionnel, permet d'associer le RelationManager à une ressource parent.
     * Ici, on lie le RelationManager à CommandeResource.
     */
    protected static ?string $relatedResource = CommandeResource::class;

    /**
     * table()
     * 
     * Configure le tableau affiché dans Filament pour cette relation.
     * Étapes :
     * 1. Définit les colonnes du tableau :
     *    - 'livre.nom' : affiche le nom du livre associé à la ligne de commande.
     *    - 'quantite' : affiche la quantité commandée.
     *    - 'livre.prix' : affiche le prix du livre associé.
     * 2. Les actions (édition, suppression, création) peuvent être ajoutées dans le tableau,
     *    mais ici aucune action supplémentaire n'est définie.
     * 
     * @param Table $table
     * @return Table
     */
    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('livre.nom')
                    ->label('Nom du livre'), // Affiche le nom du livre
                TextColumn::make('quantite'), // Affiche la quantité commandée
                TextColumn::make('livre.prix')
                    ->label('Prix'), // Affiche le prix du livre
            ])
            ->actions([
                // Actions vides pour l'instant, peuvent inclure EditAction, DeleteAction, etc.
            ]);
    }
}
