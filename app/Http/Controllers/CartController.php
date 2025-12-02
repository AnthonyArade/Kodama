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

        return view('cart', compact('cart', 'subtotal'));
    }

    public function store($livre_id)
    {
        try {

            // Check authentication
            if (! auth()->check()) {
                return redirect()->back()->with('error', 'Vous devez être connecté pour ajouter au panier');
            }

            // Validate livre exists
            $livre = Livre::find($livre_id);
            if (! $livre) {
                return redirect()->back()->with('error', 'Livre non trouvé');
            }

            // Check if item already in cart
            $existingCartItem = Panier::where('user_id', auth()->id())
                ->where('livre_id', $livre_id)
                ->first();

            if ($existingCartItem) {

                // (Optional stock check here)

                $existingCartItem->increment('quantite');

                return redirect()->back()->with('success', 'Quantité mise à jour dans le panier');
            }

            // Create new item
            Panier::create([
                'user_id'  => auth()->id(),
                'livre_id' => $livre_id,
                'quantite' => 1,
            ]);

            return redirect()->back()->with('success', 'Livre ajouté au panier avec succès');

        } catch (\Exception $e) {
            return redirect()->back()->with(
                'error',
                config('app.debug')
                    ? 'Erreur: ' . $e->getMessage()
                    : 'Erreur lors de l\'ajout au panier'
            );
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'quantite' => 'required|integer|min:1',
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
                'quantite' => $request->quantite,
            ]);

            // Calculate updated totals
            $cart     = Panier::where('user_id', auth()->id())->with('livre')->get();
            $subtotal = $cart->sum(function ($item) {
                return $item->quantite * $item->livre->prix;
            });

            return response()->json([
                'success' => true,
                'message' => 'Quantité mise à jour',
                'data'    => [
                    'item'       => $cartItem->fresh(),
                    'subtotal'   => $subtotal,
                    'item_total' => $cartItem->quantite * $cartItem->livre->prix,
                ],
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors'  => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour',
                'error'   => config('app.debug') ? $e->getMessage() : null,
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

        if ($cartItem->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Accès non autorisé');
        }

        $cartItem->increment('quantite');

        return redirect()->back()->with('success', 'Quantité augmentée');

    } catch (\Exception $e) {
        return redirect()->back()->with(
            'error',
            config('app.debug') 
                ? 'Erreur: ' . $e->getMessage()
                : 'Erreur lors de l\'augmentation de la quantité'
        );
    }
}


    /**
     * Decrement cart item quantity by 1
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
            config('app.debug')
                ? 'Erreur: ' . $e->getMessage()
                : 'Erreur lors de la réduction de la quantité'
        );
    }
}


    /**
     * Remove item from cart
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
            config('app.debug')
                ? 'Erreur: ' . $e->getMessage()
                : 'Erreur lors de la suppression'
        );
    }
}

}
