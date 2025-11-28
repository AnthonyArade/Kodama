@extends('layouts.livre')

@section('title', 'Page d\'accueil')

@section('content')

<body class="bg-white text-third">
    <!-- Featured Books Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold heading-font text-third text-center mb-4">Featured Books</h2>
            <p class="text-gray-600 text-center mb-12 max-w-2xl mx-auto">Handpicked selections from our forest of literature</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Book Card 1 -->
                {{-- creer moi une boucle foreach pour afficher les featuredcard --}}
                @foreach($featuredLivres as $featuredLivre)
                <div class="book-card bg-white rounded-lg shadow-md overflow-hidden transition-all">
                    <div class="h-48 primary-color flex items-center justify-center">
                        <div class="text-4xl text-white">🌲<img src="{{ ($featuredLivre->image) }}" alt="Image du livre"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2">{{ $featuredLivre->title }}</h3>
                        <p class="text-gray-600 text-sm mb-4">{{ $featuredLivre->description }}</p>
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-primary">{{ $featuredLivre->price }}</span>
                            <button class="btn-primary px-4 py-2 rounded text-sm transition-colors">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
                
                @endforeach
             


    <!-- Categories Section -->
    <section class="py-16 bg-white">
        
        <div class="container mx-auto px-4">
        
            <h2 class="text-3xl font-bold heading-font text-third text-center mb-4">Book Categories</h2>
            <p class="text-gray-600 text-center mb-12 max-w-2xl mx-auto">Explore our diverse collection organized by genre</p>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                
                @foreach($categories as $category)
               
                
                <div class="bg-secondary-color p-6 rounded-lg text-center hover:bg-primary hover:text-white transition-colors cursor-pointer">
                    <div class="text-3xl mb-3">📖</div>
                    <h3 class="font-bold">{{$category->nom}}</h3>
                </div>
                @endforeach
              
            
            </div>
        </div>
    </section>

@endsection

