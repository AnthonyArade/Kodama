<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LivreController;
use App\Http\Controllers\ProfileController;

//creer moi une route pour le controller LivreController index method
Route::get('/', [LivreController::class, 'index'])->name('livres.index');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
//creer moi une route pour le controller LivreController store method
Route::get('/store', [LivreController::class, 'store'])->name('livres');

Route::get('/store/category/{category}', [LivreController::class, 'storeByCategory'])->name('livresByCategory');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/panier', [CartController::class, 'index'])->name('panier.index');
    Route::post('/panier/ajouter/{livre_id}', [CartController::class, 'store'])->name('panier.store');
    Route::put('/panier/{id}', [CartController::class, 'update'])->name('panier.update');
    Route::post('/panier/{id}/increment', [CartController::class, 'increment'])->name('panier.increment');
    Route::post('/panier/{id}/decrement', [CartController::class, 'decrement'])->name('panier.decrement');
    Route::delete('/panier/{id}', [CartController::class, 'destroy'])->name('panier.destroy');
});

require __DIR__ . '/auth.php';
