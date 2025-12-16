@extends('layouts.livre')

@section('title', 'Boutique')

@section('hero-section')
    <!-- Hero Section -->
    <!-- Affiche le nom et l'auteur du livre en en-tête de page -->
    <h1 class="text-4xl font-bold heading-font text-third text-center mb-4">{{ $livre->nom }}</h1>
    <p class="text-xl text-third text-center max-w-3xl mx-auto">{{ $livre->auteur }}</p>
@endsection

@section('content')
    <!-- Breadcrumb -->
    <!-- Affiche la navigation fil d'Ariane pour revenir à l'accueil -->
    <x-breadcrumb :items="[['name' => 'Home']]" />

    <!-- Book Detail Section -->
    <!-- Contient toutes les informations détaillées sur le livre sélectionné -->
    <section class="py-8 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-8">

                <!-- Book Cover & Actions -->
                <div class="lg:w-2/5">
                    <!-- Conteneur blanc avec ombre et padding -->
                    <div class="bg-white rounded-lg shadow-lg p-6 sticky top-24">
                        <div class="flex flex-col items-center">

                            <!-- Book Cover -->
                            <!-- Affiche l'image du livre -->
                            <div class="w-64 h-80 primary-color rounded-lg shadow-md flex items-center justify-center mb-6">
                                <img src="{{ $livre->image }}" alt="Image du livre" class="w-full h-full object-cover">
                            </div>

                            <!-- Price Information -->
                            <div class="text-center mb-6">
                                <div class="mb-2">
                                    <!-- Affiche le prix du livre -->
                                    <span class="text-3xl font-bold text-primary">{{ $livre->prix }}</span>
                                </div>
                                <!-- Indication de disponibilité et livraison -->
                                <p class="text-green-600 font-medium">In Stock • Free Shipping</p>
                            </div>

                            <!-- Action Buttons (Add to Cart & Wishlist) -->
                            <div class="flex flex-col w-full gap-3 mb-6">
                                <!-- Formulaire pour ajouter le livre au panier -->
                                <form action="{{ route('panier.store', $livre->id) }}" class="w-full flex justify-center"
                                    method="POST">
                                    @csrf
                                    <button
                                        class="btn-primary py-3 rounded-lg font-medium w-full inline-flex items-center justify-center gap-2 transition-colors">
                                        <!-- Icône du panier -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        Add to Cart
                                    </button>
                                </form>

                                <!-- Bouton pour ajouter aux favoris -->
                                <button
                                    class="btn-outline py-3 rounded-lg font-medium flex items-center justify-center gap-2 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                    Add to Wishlist
                                </button>
                            </div>

                            <!-- Quick Info (Publication, Publisher) -->
                            <div class="w-full border-t pt-4">
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Published:</span>
                                        <span class="font-medium">{{ $livre->date_sortie }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Publisher:</span>
                                        <span class="font-medium">Kodama Press</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Book Details -->
                <div class="lg:w-3/5">
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <!-- Title & Author -->
                        <div class="mb-6">
                            <h1 class="text-4xl font-bold heading-font text-third mb-2">{{ $livre->nom }}</h1>
                            <p class="text-xl text-gray-600 mb-4">by <span
                                    class="font-medium text-primary">{{ $livre->auteur }}</span></p>

                            <!-- Like/Dislike Section -->
                            <div class="like-dislike-container">
                                <div class="like-count">
                                    <!-- Icône pouce levé et nombre de likes -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M1 21h4V9H1v12zm22-11c0-1.1-.9-2-2-2h-6.31l.95-4.57.03-.32c0-.41-.17-.79-.44-1.06L14.17 1 7.59 7.59C7.22 7.95 7 8.45 7 9v10c0 1.1.9 2 2 2h9c.83 0 1.54-.5 1.84-1.22l3.02-7.05c.09-.23.14-.47.14-.73v-2z" />
                                    </svg>
                                    <span>142 Likes</span>
                                </div>
                                <div class="dislike-count">
                                    <!-- Icône pouce baissé et nombre de dislikes -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M15 3H6c-.83 0-1.54.5-1.84 1.22l-3.02 7.05c-.09.23-.14.47-.14.73v2c0 1.1.9 2 2 2h6.31l-.95 4.57-.03.32c0 .41.17.79.44 1.06L9.83 23l6.59-6.59c.36-.36.58-.86.58-1.41V5c0-1.1-.9-2-2-2zm4 0v12h4V3h-4z" />
                                    </svg>
                                    <span>8 Dislikes</span>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-8">
                            <h2 class="text-2xl font-bold heading-font mb-4">About This Book</h2>
                            <p class="text-gray-700 leading-relaxed mb-4">
                                {{ $livre->description }}
                            </p>
                        </div>

                        <!-- Categories -->
                        <div class="mb-8">
                            <h4 class="font-bold text-gray-700 mb-2">Categories</h4>
                            <div class="flex flex-wrap gap-2">
                                <!-- Affiche le nom de la catégorie du livre -->
                                <span
                                    class="bg-primary bg-opacity-10 text-primary px-3 py-1 rounded-full text-sm">{{ $livre->category->nom }}</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Related Books Section -->
    <!-- Affiche les livres suggérés ou similaires -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold heading-font text-third text-center mb-8">You Might Also Like</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($featuredLivres as $featuredLivre)
                    <a href="{{ route('livres.show', $featuredLivre->id) }}">
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                            <!-- Image du livre -->
                            <div class="h-48 secondary-color flex items-center justify-center">
                                @if (\Illuminate\Support\Str::startsWith($featuredLivre->image, 'http'))
                                    <img class="w-full h-full object-cover" src="{{ $featuredLivre->image }}"
                                        alt="Image">
                                @else
                                    <img class="w-full h-full object-cover"
                                        src="{{ Storage::disk('public')->url($featuredLivre->image) }}" alt="Image">
                                @endif
                            </div>
                            <div class="p-4">
                                <!-- Nom et auteur du livre -->
                                <h3 class="font-bold text-lg mb-1">{{ $featuredLivre->nom }}</h3>
                                <p class="text-gray-600 text-sm mb-2">{{ $featuredLivre->auteur }}</p>
                                <!-- Prix et bouton d'ajout au panier -->
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-primary">{{ $featuredLivre->prix }}</span>
                                    <form action="{{ route('panier.store', $featuredLivre->id) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        <button class="btn-primary p-2 rounded-full transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
