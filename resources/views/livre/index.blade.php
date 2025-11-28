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
                <div class="book-card bg-white rounded-lg shadow-md overflow-hidden transition-all">
                    <div class="h-48 primary-color flex items-center justify-center">
                        <div class="text-4xl text-white">🌲</div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2">The Forest's Whisper</h3>
                        <p class="text-gray-600 text-sm mb-4">A journey through mystical woods and ancient secrets.</p>
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-primary">$24.99</span>
                            <button class="btn-primary px-4 py-2 rounded text-sm transition-colors">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Book Card 2 -->
                <div class="book-card bg-white rounded-lg shadow-md overflow-hidden transition-all">
                    <div class="h-48 secondary-color flex items-center justify-center">
                        <div class="text-4xl text-third">🌙</div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2">Moonlight Sonata</h3>
                        <p class="text-gray-600 text-sm mb-4">A tale of music, love, and midnight mysteries.</p>
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-primary">$19.99</span>
                            <button class="btn-primary px-4 py-2 rounded text-sm transition-colors">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Book Card 3 -->
                <div class="book-card bg-white rounded-lg shadow-md overflow-hidden transition-all">
                    <div class="h-48 primary-color flex items-center justify-center">
                        <div class="text-4xl text-white">🚀</div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2">Beyond the Stars</h3>
                        <p class="text-gray-600 text-sm mb-4">Exploring the final frontier and what lies beyond.</p>
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-primary">$27.99</span>
                            <button class="btn-primary px-4 py-2 rounded text-sm transition-colors">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Book Card 4 -->
                <div class="book-card bg-white rounded-lg shadow-md overflow-hidden transition-all">
                    <div class="h-48 secondary-color flex items-center justify-center">
                        <div class="text-4xl text-third">🏰</div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2">The Castle of Dreams</h3>
                        <p class="text-gray-600 text-sm mb-4">A fantasy epic of kingdoms, magic, and destiny.</p>
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-primary">$22.99</span>
                            <button class="btn-primary px-4 py-2 rounded text-sm transition-colors">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <button class="btn-outline px-6 py-3 rounded-md font-medium transition-colors">
                    View All Books
                </button>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold heading-font text-third text-center mb-4">Book Categories</h2>
            <p class="text-gray-600 text-center mb-12 max-w-2xl mx-auto">Explore our diverse collection organized by genre</p>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-secondary-color p-6 rounded-lg text-center hover:bg-primary hover:text-white transition-colors cursor-pointer">
                    <div class="text-3xl mb-3">📖</div>
                    <h3 class="font-bold">Fiction</h3>
                </div>
                <div class="bg-primary-color p-6 rounded-lg text-center text-white hover:bg-secondary hover:text-third transition-colors cursor-pointer">
                    <div class="text-3xl mb-3">🔍</div>
                    <h3 class="font-bold">Mystery</h3>
                </div>
                <div class="bg-secondary-color p-6 rounded-lg text-center hover:bg-primary hover:text-white transition-colors cursor-pointer">
                    <div class="text-3xl mb-3">🚀</div>
                    <h3 class="font-bold">Sci-Fi</h3>
                </div>
                <div class="bg-primary-color p-6 rounded-lg text-center text-white hover:bg-secondary hover:text-third transition-colors cursor-pointer">
                    <div class="text-3xl mb-3">💖</div>
                    <h3 class="font-bold">Romance</h3>
                </div>
                <div class="bg-primary-color p-6 rounded-lg text-center text-white hover:bg-secondary hover:text-third transition-colors cursor-pointer">
                    <div class="text-3xl mb-3">👑</div>
                    <h3 class="font-bold">Fantasy</h3>
                </div>
                <div class="bg-secondary-color p-6 rounded-lg text-center hover:bg-primary hover:text-white transition-colors cursor-pointer">
                    <div class="text-3xl mb-3">📚</div>
                    <h3 class="font-bold">Non-Fiction</h3>
                </div>
                <div class="bg-secondary-color p-6 rounded-lg text-center hover:bg-primary hover:text-white transition-colors cursor-pointer">
                    <div class="text-3xl mb-3">👶</div>
                    <h3 class="font-bold">Children</h3>
                </div>
                <div class="bg-primary-color p-6 rounded-lg text-center text-white hover:bg-secondary hover:text-third transition-colors cursor-pointer">
                    <div class="text-3xl mb-3">🎨</div>
                    <h3 class="font-bold">Art</h3>
                </div>
            </div>
        </div>
    </section>

@endsection

