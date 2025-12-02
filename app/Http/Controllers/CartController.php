<?php
namespace App\Http\Controllers;

use App\Models\Livre;
use App\Models\Panier;
use App\Models\Commande;
use App\Models\LigneDeCommande;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

/**
 * CartController
 * 
 * Ce contrôleur gère toutes les opérations liées au panier et aux commandes des utilisateurs.
 * Il permet :
 * - d'afficher le panier
 * - d'ajouter des articles au panier
 * - d'incrémenter ou décrémenter la quantité d'articles
 * - de supprimer des articles
 * - de transformer le panier en commande
 * - d'afficher les commandes passées
 */
class CartController extends Controller
{
    /**
     * index()
     * 
     * Affiche le contenu du panier pour l'utilisateur connecté.
     * Étapes :
     * 1. Récupère l'ID de l'utilisateur connecté via Auth.
     * 2. Récupère tous les articles du panier appartenant à cet utilisateur, en préchargeant la relation 'livre' pour éviter les requêtes supplémentaires (eager loading).
     * 3. Calcule le sous-total du panier en multipliant la quantité de chaque article par le prix du livre associé.
     * 4. Retourne la vue 'cart' avec les données du panier et le sous-total.
     */
    
    public function index()
    {
        $user = Auth::id();
        $cart = Panier::where('user_id', $user)
            ->with('livre') // Précharge les informations du livre pour chaque article
            ->get();

        $subtotal = $cart->sum(function ($item) {
            return $item->quantite * $item->livre->prix;
        });

        return view('cart', compact('cart', 'subtotal'));
    }

    /**
     * store($livre_id)
     * 
     * Ajoute un livre au panier.
     * Étapes et vérifications :
     * 1. Vérifie que l'utilisateur est connecté. Sinon, redirige avec un message d'erreur.
     * 2. Vérifie que le livre existe. Sinon, redirige avec un message d'erreur.
     * 3. Vérifie si le livre est déjà présent dans le panier de l'utilisateur.
     *    - Si oui, incrémente la quantité de cet article.
     *    - Si non, crée une nouvelle entrée dans le panier avec quantité = 1.
     * 4. Gère les exceptions et retourne des messages d'erreur appropriés selon le mode debug.
     */
    
    public function store($livre_id)
    {
        try {
            if (! auth()->check()) {
                return redirect()->back()->with('error', 'Vous devez être connecté pour ajouter au panier');
            }

            $livre = Livre::find($livre_id);
            if (! $livre) {
                return redirect()->back()->with('error', 'Livre non trouvé');
            }

            $existingCartItem = Panier::where('user_id', auth()->id())
                ->where('livre_id', $livre_id)
                ->first();

            if ($existingCartItem) {
                $existingCartItem->increment('quantite');
                return redirect()->back()->with('success', 'Quantité mise à jour dans le panier');
            }

            Panier::create([
                'user_id' => auth()->id(),
                'livre_id' => $livre_id,
                'quantite' => 1,
            ]);

            return redirect()->back()->with('success', 'Livre ajouté au panier avec succès');

        } catch (\Exception $e) {
            return redirect()->back()->with(
                'error',
                config('app.debug') ? 'Erreur: ' . $e->getMessage() : 'Erreur lors de l\'ajout au panier'
            );
        }
    }

    /**
     * increment($id)
     * 
     * Incrémente la quantité d'un article du panier de 1.
     * Étapes :
     * 1. Récupère l'article avec la relation 'livre'.
     * 2. Vérifie que l'article appartient à l'utilisateur connecté. Sinon, renvoie une erreur.
     * 3. Incrémente la quantité et redirige avec un message de succès.
     * 4. Gère les exceptions et retourne un message d'erreur approprié.
     */
    
    public function increment($id)
    {
        try {
            $cartItem = Panier::with('livre')->findOrFail($id);

            if ($cartItem->user_id !== auth()->id()) {
                return redirect()->back()->with('error', 'Accès non autorisé');
            }

            $cartItem->increment('quantite');

            return redirect()->back()->with('success', 'Quantité augmentée');

        } catch (\Exception $e) {
            return redirect()->back()->with(
                'error',
                config('app.debug') ? 'Erreur: ' . $e->getMessage() : 'Erreur lors de l\'augmentation de la quantité'
            );
        }
    }

    /**
     * decrement($id)
     * 
     * Décrémente la quantité d'un article du panier de 1.
     * Étapes :
     * 1. Récupère l'article.
     * 2. Vérifie que l'article appartient à l'utilisateur connecté. Sinon, renvoie une erreur.
     * 3. Si la quantité est <= 1, supprime l'article du panier.
     * 4. Sinon, décrémente la quantité et redirige avec un message de succès.
     * 5. Gère les exceptions et retourne un message d'erreur approprié.
     */
    
    public function decrement($id)
    {
        try {
            $cartItem = Panier::findOrFail($id);

            if ($cartItem->user_id !== auth()->id()) {
                return redirect()->back()->with('error', 'Accès non autorisé');
            }

            if ($cartItem->quantite <= 1) {
                $cartItem->delete();
                return redirect()->back()->with('success', 'Article retiré du panier');
            }

            $cartItem->decrement('quantite');

            return redirect()->back()->with('success', 'Quantité réduite');

        } catch (\Exception $e) {
            return redirect()->back()->with(
                'error',
                config('app.debug') ? 'Erreur: ' . $e->getMessage() : 'Erreur lors de la réduction de la quantité'
            );
        }
    }

    /**
     * destroy($id)
     * 
     * Supprime un article du panier.
     * Étapes :
     * 1. Récupère l'article.
     * 2. Vérifie que l'article appartient à l'utilisateur connecté. Sinon, renvoie une erreur.
     * 3. Supprime l'article et retourne un message de succès.
     * 4. Gère les exceptions et retourne un message d'erreur approprié.
     */
    
    public function destroy($id)
    {
        try {
            $cartItem = Panier::findOrFail($id);

            if ($cartItem->user_id !== auth()->id()) {
                return redirect()->back()->with('error', 'Accès non autorisé');
            }

            $livreTitle = $cartItem->livre->titre ?? 'Article';
            $cartItem->delete();

            return redirect()->back()->with('success', '"' . $livreTitle . '" retiré du panier');

        } catch (\Exception $e) {
            return redirect()->back()->with(
                'error',
                config('app.debug') ? 'Erreur: ' . $e->getMessage() : 'Erreur lors de la suppression'
            );
        }
    }

    /**
     * command()
     * 
     * Transforme tous les articles du panier en commande.
     * Étapes :
     * 1. Récupère tous les articles du panier de l'utilisateur.
     * 2. Vérifie que le panier n'est pas vide.
     * 3. Crée une commande avec le total calculé.
     * 4. Crée une LigneDeCommande pour chaque article du panier.
     * 5. Vide le panier.
     * 6. Redirige vers la page de commande avec un message de succès.
     */
    
    public function command()
    {
        $user = auth()->user();
        $cartItems = Panier::with('livre')->where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        $command = Commande::create([
            'user_id' => $user->id,
            'status' => 'pending',
            'total' => $cartItems->sum(function ($item) {
                return $item->livre->prix * $item->quantite;
            }),
        ]);

        foreach ($cartItems as $item) {
            LigneDeCommande::create([
                'commande_id' => $command->id,
                'livre_id' => $item->livre_id,
                'quantite' => $item->quantite
            ]);
        }

        Panier::where('user_id', $user->id)->delete();

        return redirect()->route('order', $command->id)
            ->with('success', 'Your order has been placed successfully!');
    }

    /**
     * order($id)
     * 
     * Affiche les détails d'une commande spécifique.
     * Étapes :
     * 1. Récupère la commande avec ses lignes associées.
     * 2. Vérifie que la commande existe, sinon renvoie une erreur 404.
     * 3. Vérifie via Gate que l'utilisateur peut accéder à cette commande.
     * 4. Retourne la vue 'order' avec les informations de la commande.
     */
    
    public function order($id)
    {
        $command = Commande::with('ligne')->find($id);

        if (!$command) {
            abort(404, 'Commande non trouvée');
        }

        Gate::authorize('access-order', $command->user_id);

        return view('order', compact('command'));
    }
}
