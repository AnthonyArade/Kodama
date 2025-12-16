@extends('layouts.livre')

@section('title', 'Page d\'accueil')

@section('hero-section')
    <!-- Hero Section -->
    <!-- Section d'introduction principale sur la page d'accueil avec texte et visuel -->
    <div class="flex flex-col md:flex-row items-center">

        <!-- Texte principal et bouton -->
        <div class="md:w-1/2 mb-10 md:mb-0">
            <!-- Titre principal -->
            <h1 class="text-4xl md:text-5xl font-bold heading-font text-third mb-6">
                Discover Your Next Favorite Book
            </h1>
            <!-- Description -->
            <p class="text-xl text-third mb-8 opacity-90">
                Kodama brings you a carefully curated collection of books for every reader. Find your next adventure in our
                forest of stories.
            </p>
            <!-- Bouton vers la collection complète -->
            <div class="flex space-x-4">
                <a href="{{ route('livres') }}">
                    <button class="btn-primary px-6 py-3 rounded-md font-medium transition-colors">
                        Browse Collection
                    </button>
                </a>
            </div>
        </div>

        <!-- Visuel Hero -->
        <div class="md:w-1/2 flex justify-center">
            <div class="relative">
                <!-- Carte de fond stylisée avec rotation -->
                <div class="w-64 h-80 third-color rounded-lg shadow-xl transform rotate-3"></div>
                <!-- Carte principale contenant le logo et le slogan -->
                <div
                    class="w-64 h-80 bg-white border-2 border-primary rounded-lg shadow-xl absolute top-4 left-4 transform -rotate-2 flex items-center justify-center">
                    <div class="text-center p-6">
                        <!-- Logo de l'entreprise -->
                        <img class="w-20 justify-self-center" src="{{ asset('img/logo.png') }}" alt="logo">
                        <!-- Slogan -->
                        <p class="text-primary mt-2">Where stories grow</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('content')
    <!-- Breadcrumb -->
    <!-- Navigation fil d'Ariane pour indiquer la position de l'utilisateur -->
    <x-breadcrumb :items="[['name' => 'Home']]" />

    <!-- Featured Books Section -->
    <!-- Affiche les livres mis en avant sur la page d'accueil -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <!-- Titre de la section -->
            <h2 class="text-3xl font-bold heading-font text-third text-center mb-4">Featured Books</h2>
            <!-- Description de la section -->
            <p class="text-gray-600 text-center mb-12 max-w-2xl mx-auto">
                Handpicked selections from our forest of literature
            </p>

            <!-- Grille des livres mis en avant -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Boucle sur les livres en vedette -->
                @foreach ($featuredLivres as $featuredLivre)
                    <div
                        class="book-card flex flex-col bg-white rounded-lg shadow-md overflow-hidden transition-all h-full">

                        <!-- Clickable image and title -->
                        <a href="{{ route('livres.show', $featuredLivre->id) }}">
                            <div class="h-64 primary-color flex items-center justify-center overflow-hidden">
                                @if (\Illuminate\Support\Str::startsWith($featuredLivre->image, 'http'))
                                    <img class="w-full h-full object-cover" src="{{ $featuredLivre->image }}"
                                        alt="Image">
                                @else
                                    <img class="w-full h-full object-cover"
                                        src="{{ Storage::disk('public')->url($featuredLivre->image) }}" alt="Image">
                                @endif
                            </div>
                        </a>

                        <div class="p-6 flex flex-col flex-1">

                            <a href="{{ route('livres.show', $featuredLivre->id) }}">
                                <h3 class="font-bold text-lg mb-2">{{ $featuredLivre->nom }}</h3>
                            </a>

                            <p class="text-gray-600 text-sm mb-4">{{ $featuredLivre->description }}</p>

                            <div class="flex mt-auto justify-between items-center">
                                <span class="font-bold text-primary">{{ $featuredLivre->prix }}€</span>

                                @auth
                                    <form action="{{ route('panier.store', $featuredLivre->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="btn-primary px-4 py-2 rounded text-sm transition-colors hover:bg-blue-600">
                                            Add to Cart
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}"
                                        class="btn-primary px-4 py-2 rounded text-sm transition-colors hover:bg-blue-600">
                                        Add to Cart
                                    </a>
                                @endauth
                            </div>

                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <!-- Affiche les catégories de livres disponibles -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <!-- Titre de la section -->
            <h2 class="text-3xl font-bold heading-font text-third text-center mb-4">Book Categories</h2>
            <!-- Description de la section -->
            <p class="text-gray-600 text-center mb-12 max-w-2xl mx-auto">
                Explore our diverse collection organized by genre
            </p>

            <!-- Grille des catégories -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <!-- Boucle sur chaque catégorie -->
                @foreach ($categories as $category)
                    <a href="{{ route('livresByCategory', $category->id) }}">
                        <div
                            class="bg-secondary-color p-6 rounded-lg text-center hover:bg-primary hover:text-green-700 transition-colors cursor-pointer">
                            <!-- Icône de la catégorie -->
                            <div class="text-3xl mb-3">{{ $category->icon }}</div>
                            <!-- Nom de la catégorie -->
                            <h3 class="font-bold">{{ $category->nom }}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
