<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Livre;
use App\Models\Commande;
use App\Models\LigneDeCommande;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $books = Livre::all();

        User::all()->each(function ($user) use ($books) {
            for ($i = 0; $i < 3; $i++) {
                // Create a commande for the user
                $commande = Commande::factory()->create([
                    'user_id' => $user->id,
                ]);

                // Select random number of books between 1 and 10
                $selectedBooks = $books->random(rand(1, 5));

                $total = 0;

                foreach ($selectedBooks as $book) {
                    $quantity = rand(1, 5); // random quantity
                    //somme des livres en fonction de la quantite
                    $total += $book->prix * $quantity;

                    LigneDeCommande::factory()->create([
                        'commande_id' => $commande->id,
                        'livre_id' => $book->id,
                        'quantite' => $quantity,
                    ]);
                }

                // Update total
                $commande->update(['total' => $total]);
            }
        });
    }
}
