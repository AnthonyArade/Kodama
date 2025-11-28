@extends('layouts.livre')

@section('title', 'Page d\'accueil')

@section('hero-section')
    <div class="md:w-1/2 mb-10 md:mb-0">
        <h1 class="text-4xl md:text-5xl font-bold heading-font text-third mb-6">Discover Your Next Favorite Book</h1>
        <p class="text-xl text-third mb-8 opacity-90">Kodama brings you a carefully curated collection of books for every
            reader. Find your next adventure in our forest of stories.</p>
        <div class="flex space-x-4">
            <button class="btn-primary px-6 py-3 rounded-md font-medium transition-colors">
                Browse Collection
            </button>
        </div>
    </div>
    <div class="md:w-1/2 flex justify-center">
        <div class="relative">
            <div class="w-64 h-80 third-color rounded-lg shadow-xl transform rotate-3"></div>
            <div
                class="w-64 h-80 bg-white border-2 border-primary rounded-lg shadow-xl absolute top-4 left-4 transform -rotate-2 flex items-center justify-center">
                <div class="text-center p-6">
                    <img class="w-20 justify-self-center" src="{{ asset('img/logo.png') }}" alt="logo">
                    <p class="text-primary mt-2">Where stories grow</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <!-- Breadcrumb -->
    <x-breadcrumb :items="[['name' => 'Home']]" />
    <!-- Featured Books Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold heading-font text-third text-center mb-4">Featured Books</h2>
            <p class="text-gray-600 text-center mb-12 max-w-2xl mx-auto">Handpicked selections from our forest of
                literature</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Book Card 1 -->
                {{-- creer moi une boucle foreach pour afficher les featuredcard --}}
                @foreach ($featuredLivres as $featuredLivre)
                    <div
                        class="book-card flex flex-col justify-around bg-white rounded-lg shadow-md overflow-hidden transition-all">
                        <div class="h-64 primary-color flex items-center justify-center overflow-hidden">
                            <img src="{{ $featuredLivre->image }}" alt="Image du livre" class="w-full h-full object-cover">
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-lg mb-2">{{ $featuredLivre->nom }}</h3>
                            <p class="text-gray-600 text-sm mb-4">{{ $featuredLivre->description }}</p>
                            <div class="flex justify-between items-center">
                                <span class="font-bold text-primary">{{ $featuredLivre->prix }}€</span>
                                <button class="btn-primary px-4 py-2 rounded text-sm transition-colors">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Categories Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold heading-font text-third text-center mb-4">Book Categories</h2>
            <p class="text-gray-600 text-center mb-12 max-w-2xl mx-auto">Explore our diverse collection
                organized by genre</p>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach ($categories as $category)
                    <div
                        class="bg-secondary-color p-6 rounded-lg text-center hover:bg-primary hover:text-white transition-colors cursor-pointer">
                        <div class="text-3xl mb-3">{{ $category->icon }}</div>
                        <h3 class="font-bold">{{ $category->nom }}</h3>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
