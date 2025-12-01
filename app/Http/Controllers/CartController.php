<?php
namespace App\Http\Controllers;

use App\Models\Livre;
use App\Models\Panier;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {

        $user = Auth::id();
        $cart = Panier::where('user_id', $user)
        ->with('livre') // Eager load the livre relationship
        ->get();

        $subtotal = $cart->sum(function ($item) {
        return $item->quantite * $item->livre->prix;
    });

        return view('cart', compact('cart','subtotal'));
    }

    public function store($livre_id)
    {
        try {
            // Validate user is authenticated
            if (! auth()->check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vous devez être connecté pour ajouter au panier',
                ], 401);
            }

            // Validate livre exists
            $livre = Livre::find($livre_id);
            if (! $livre) {
                return response()->json([
                    'success' => false,
                    'message' => 'Livre non trouvé',
                ], 404);
            }

            // Validate stock availability
            // if ($livre->stock_disponible <= 0) {
            //     return response()->json([
            //         'success' => false,
            //         'message' => 'Ce livre est actuellement en rupture de stock',
            //     ], 400);
            // }

            // Check if livre already exists in cart for this user
            $existingCartItem = Panier::where('user_id', auth()->id())
                ->where('livre_id', $livre_id)
                ->first();

            if ($existingCartItem) {
                // Update quantity if item already exists (increment by 1)
                // Check stock before incrementing
                // if ($existingCartItem->quantite >= $livre->stock_disponible) {
                //     return response()->json([
                //         'success' => false,
                //         'message' => 'Stock insuffisant pour ajouter une quantité supplémentaire',
                //     ], 400);
                // }

                $existingCartItem->increment('quantite');

                return response()->json([
                    'success' => true,
                    'message' => 'Quantité mise à jour dans le panier',
                    'data'    => $existingCartItem->fresh(),
                ], 200);
            }

            // Create new cart item
            $panier = Panier::create([
                'user_id'  => auth()->id(),
                'livre_id' => $livre_id,
                'quantite' => 1,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Livre ajouté au panier avec succès',
                'data'    => $panier,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'ajout au panier',
                'error'   => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'quantite' => 'required|integer|min:1'
            ]);

            $cartItem = Panier::with('livre')->findOrFail($id);

            // Check if item belongs to current user
            if ($cartItem->user_id !== auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Accès non autorisé',
                ], 403);
            }

            // Check stock availability
            if ($request->quantite > $cartItem->livre->stock_disponible) {
                return response()->json([
                    'success' => false,
                    'message' => 'Quantité demandée non disponible. Stock restant: ' . $cartItem->livre->stock_disponible,
                ], 400);
            }

            $cartItem->update([
                'quantite' => $request->quantite
            ]);

            // Calculate updated totals
            $cart = Panier::where('user_id', auth()->id())->with('livre')->get();
            $subtotal = $cart->sum(function ($item) {
                return $item->quantite * $item->livre->prix;
            });

            return response()->json([
                'success' => true,
                'message' => 'Quantité mise à jour',
                'data' => [
                    'item' => $cartItem->fresh(),
                    'subtotal' => $subtotal,
                    'item_total' => $cartItem->quantite * $cartItem->livre->prix
                ]
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Increment cart item quantity by 1
     */
    public function increment($id)
    {
        try {
            $cartItem = Panier::with('livre')->findOrFail($id);

            // Check if item belongs to current user
            if ($cartItem->user_id !== auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Accès non autorisé',
                ], 403);
            }

            $cartItem->increment('quantite');

            return response()->json([
                'success' => true,
                'message' => 'Quantité augmentée',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'augmentation de la quantité',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Decrement cart item quantity by 1
     */
    public function decrement($id)
    {
        try {
            $cartItem = Panier::findOrFail($id);

            // Check if item belongs to current user
            if ($cartItem->user_id !== auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Accès non autorisé',
                ], 403);
            }

            // If quantity is 1, remove the item
            if ($cartItem->quantite <= 1) {
                $cartItem->delete();

                return response()->json([
                    'success' => true,
                    'message' => 'Article retiré du panier',
                ], 200);
            }

            $cartItem->decrement('quantite');

            return response()->json([
                'success' => true,
                'message' => 'Quantité réduite',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la réduction de la quantité',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Remove item from cart
     */
    public function destroy($id)
    {
        try {
            $cartItem = Panier::findOrFail($id);

            // Check if item belongs to current user
            if ($cartItem->user_id !== auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Accès non autorisé',
                ], 403);
            }

            $livreTitle = $cartItem->livre->titre ?? 'Article';
            $cartItem->delete();

            // Calculate updated totals
            $cart = Panier::where('user_id', auth()->id())->with('livre')->get();
            $subtotal = $cart->sum(function ($item) {
                return $item->quantite * $item->livre->prix;
            });

            return response()->json([
                'success' => true,
                'message' => '"' . $livreTitle . '" retiré du panier',
                'data' => [
                    'removed' => true,
                    'subtotal' => $subtotal,
                    'cart_count' => $cart->sum('quantite')
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
}
