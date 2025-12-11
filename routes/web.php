<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\LivreController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/run-migrate', function (Request $request) {
    Artisan::call('migrate:fresh', ['--force' => true]);
    Artisan::call('db:seed', ['--class' => 'DatabaseSeeder', '--force' => true]);

    return Artisan::output();
});

// Route pour afficher la liste des livres (index) via LivreController
Route::get('/', [LivreController::class, 'index'])->name('livres.index');

// Route pour afficher le panier via CartController
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// Route pour accéder à la page "store" (méthode store de LivreController)
Route::get('/store', [LivreController::class, 'store'])->name('livres');

// Route pour filtrer les livres par catégorie
Route::get('/store/category/{category}', [LivreController::class, 'storeByCategory'])->name('livresByCategory');

// Route pour afficher les détails d'un livre spécifique
Route::get('/livre/{id}', [LivreController::class, 'show'])->name('livres.show');

// Route vers le dashboard avec middleware auth et vérification
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Groupe de routes nécessitant l'authentification
Route::middleware('auth')->group(function () {

    // Profil utilisateur : édition, mise à jour, suppression
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Panier : affichage, ajout, mise à jour, suppression, incrémentation/décrémentation
    Route::get('/panier', [CartController::class, 'index'])->name('panier.index');
    Route::post('/panier/ajouter/{livre_id}', [CartController::class, 'store'])->name('panier.store');
    Route::put('/panier/{id}', [CartController::class, 'update'])->name('panier.update');
    Route::post('/panier/{id}/increment', [CartController::class, 'increment'])->name('panier.increment');
    Route::post('/panier/{id}/decrement', [CartController::class, 'decrement'])->name('panier.decrement');
    Route::delete('/panier/{id}', [CartController::class, 'destroy'])->name('panier.destroy');

    // Commande : créer une commande à partir du panier et afficher une commande spécifique
    Route::get('/command', [CartController::class, 'command'])->name('command');
    Route::get('order/{id}', [CartController::class, 'order'])->name('order');
});

// Inclusion des routes d'authentification générées par Laravel
require __DIR__ . '/auth.php';
