@extends('layouts.livre')

@section('title', 'Boutique')

@section('hero-section')
    <!-- Section Hero : Titre et description de la page panier -->
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-5xl font-bold heading-font text-third mb-6">Your Shopping Cart</h1>
        <p class="text-xl text-third max-w-2xl mx-auto">
            Review your selected books and proceed to checkout. Your next great read is just a click away!
        </p>
    </div>
@endsection

@section('content')
    <!-- Breadcrumb -->
    <x-breadcrumb :items="[['name' => 'Home', 'url' => route('livres.index')], ['name' => 'Cart']]" />

    <!-- Section principale du panier -->
    <section class="py-8 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-8">

                <!-- Liste des articles du panier -->
                <div class="lg:w-2/3">
                    <div class="bg-white rounded-lg shadow-lg p-6">

                        <!-- En-tête de la liste des articles -->
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold heading-font">Cart Items</h2>
                            <span class="text-gray-600">{{ $cart->count() }} item(s)</span>
                        </div>

                        <!-- Liste des articles -->
                        <div class="space-y-6">
                            @foreach ($cart as $cartItem)
                                <!-- Lien vers la page du livre -->
                                <a href="{{ route('livres.show', $cartItem->livre->id) }}">
                                    <div class="cart-item flex flex-col sm:flex-row gap-4 p-4 border-b border-gray-200 transition-colors">

                                        <!-- Image du livre -->
                                        <div class="w-24 h-32 primary-color rounded flex items-center justify-center flex-shrink-0">
                                            <img src="{{ $cartItem->livre->image }}" alt="Image du livre"
                                                class="w-full h-full object-cover">
                                        </div>
                                </a>

                                <!-- Informations sur le livre : nom, auteur, prix et quantités -->
                                <div class="flex-grow">
                                    <div class="flex justify-between">
                                        <div>
                                            <h3 class="font-bold text-lg">{{ $cartItem->livre->nom }}</h3>
                                            <p class="text-gray-600">{{ $cartItem->livre->auteur }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold text-primary text-lg">{{ $cartItem->livre->prix }}€</p>
                                        </div>
                                    </div>

                                    <!-- Contrôle de la quantité et suppression du produit -->
                                    <div class="flex items-center justify-between mt-4">

                                        <!-- Contrôles de quantité -->
                                        <div class="flex items-center gap-3">
                                            <span class="text-gray-600">Quantité : </span>
                                            <div class="flex items-center border border-gray-300 rounded">

                                                <!-- Décrémenter la quantité -->
                                                <form method="POST" action="{{ route('panier.decrement', $cartItem->id) }}" class="inline">
                                                    @csrf
                                                    <button type="submit" class="px-3 py-1 text-gray-600 hover:bg-gray-100">-</button>
                                                </form>

                                                <!-- Affichage de la quantité actuelle -->
                                                <span class="quantity-input px-3 py-1">{{ $cartItem->quantite }}</span>

                                                <!-- Incrémenter la quantité -->
                                                <form method="POST" action="{{ route('panier.increment', $cartItem->id) }}" class="inline">
                                                    @csrf
                                                    <button type="submit" class="px-3 py-1 text-gray-600 hover:bg-gray-100">+</button>
                                                </form>
                                            </div>
                                        </div>

                                        <!-- Bouton pour supprimer l'article du panier -->
                                        <form method="POST" action="{{ route('panier.destroy', $cartItem->id) }}" class="inline"
                                            onsubmit="return confirm('Are you sure you want to remove this item?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-800 transition-colors flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Remove
                                            </button>
                                        </form>
                                    </div>
                                </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Bouton continuer les achats -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <a href="{{ route('livres') }}"
                            class="btn-outline inline-flex items-center gap-2 px-6 py-3 rounded-lg font-medium transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>

            <!-- Résumé de la commande -->
            <div class="lg:w-1/3">
                <div class="bg-white rounded-lg shadow-lg p-6 sticky top-24">
                    <h2 class="text-2xl font-bold heading-font mb-6">Order Summary</h2>

                    <!-- Détails de la commande : sous-total, frais, taxes, total -->
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal ({{ $cart->count() }} item(s))</span>
                            <span class="font-medium">{{ $subtotal }}€</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Shipping</span>
                            <span class="font-medium text-green-600">9.99€</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tax</span>
                            <span class="font-medium">4.80€</span>
                        </div>
                        <div class="border-t border-gray-200 pt-4">
                            <div class="flex justify-between text-lg font-bold">
                                <span>Total</span>
                                <span>{{ $subtotal + 9.99 + 4.8 }}€</span>
                            </div>
                        </div>
                    </div>

                    <!-- Code promo -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2">Promo Code</label>
                        <div class="flex gap-2">
                            <input type="text" placeholder="Enter code"
                                class="flex-grow px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                            <button class="btn-outline px-4 py-2 rounded-md font-medium transition-colors">
                                Apply
                            </button>
                        </div>
                    </div>

                    <!-- Bouton de validation de commande -->
                    <a href="{{ route('command') }}">
                        <button class="w-full btn-primary py-3 rounded-lg font-medium text-lg transition-colors mb-4">
                            Proceed to Checkout
                        </button>
                    </a>

                    <!-- Message de sécurité -->
                    <div class="text-center text-sm text-gray-500">
                        <div class="flex justify-center items-center gap-2 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Secure checkout
                        </div>
                        <p>Your personal information is always protected</p>
                    </div>
                </div>

                <!-- Section Support -->
                <div class="bg-white rounded-lg shadow-lg p-6 mt-6">
                    <h3 class="font-bold text-lg mb-4">Need Help?</h3>
                    <div class="space-y-3">

                        <!-- Contact support téléphonique -->
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>Contact Support: (555) 123-4567</span>
                        </div>

                        <!-- Live chat -->
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                            <span>Live Chat Available</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
