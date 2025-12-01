@extends('layouts.livre')

@section('title', 'Boutique')

@section('hero-section')
                

@section('content')
<!-- Breadcrumb -->
<x-breadcrumb :items="[['name' => 'Home']]" />
    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Filters Sidebar -->
            <div class="lg:w-1/4">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold heading-font">Filters</h2>
                        <button class="text-primary text-sm hover:underline">Clear All</button>
                    </div>

                    <!-- Search -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2">Search Books</label>
                        <div class="relative">
                            <input type="text" placeholder="Title, author, keyword..." class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute right-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="mb-6">
                        <h3 class="font-bold mb-3">Categories</h3>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded text-primary focus:ring-primary">
                                <span class="ml-2">Fiction</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded text-primary focus:ring-primary">
                                <span class="ml-2">Mystery & Thriller</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded text-primary focus:ring-primary">
                                <span class="ml-2">Science Fiction</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded text-primary focus:ring-primary">
                                <span class="ml-2">Romance</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded text-primary focus:ring-primary">
                                <span class="ml-2">Fantasy</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded text-primary focus:ring-primary">
                                <span class="ml-2">Non-Fiction</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded text-primary focus:ring-primary">
                                <span class="ml-2">Biography</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded text-primary focus:ring-primary">
                                <span class="ml-2">Children's Books</span>
                            </label>
                        </div>
                    </div>

                    <!-- Price Range -->
                    <div class="mb-6">
                        <h3 class="font-bold mb-3">Price Range</h3>
                        <div class="mb-2">
                            <input type="range" min="0" max="100" value="50" class="w-full">
                        </div>
                        <div class="flex justify-between text-sm">
                            <span>$0</span>
                            <span>$50</span>
                            <span>$100+</span>
                        </div>
                    </div>

                    <button class="w-full btn-primary py-2 rounded-md font-medium transition-colors">
                        Apply Filters
                    </button>
                </div>
            </div>

            <!-- Books Listing -->
            <div class="lg:w-3/4">
                <!-- Sorting and View Options -->
                
                {{-- creer moi une boucle foreach pour afficher les livres --}}
                
                
                
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                    <p class="text-gray-600 mb-4 md:mb-0">Showing 1-12 of 245 results</p>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center">
                            <span class="mr-2 text-gray-600">Sort by:</span>
                            <select class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                <option>Featured</option>
                                <option>Newest</option>
                                <option>Price: Low to High</option>
                                <option>Price: High to Low</option>
                                <option>Most Liked</option>
                                <option>Most Popular</option>
                            </select>
                        </div>
                        <div class="flex border border-gray-300 rounded-md overflow-hidden">
                            <button class="p-2 bg-gray-100 border-r border-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                </svg>
                            </button>
                            <button class="p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Books Grid -->
                <div class="grid grid-cols-3 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8"> 
                    <!-- Book 1 -->
                    @foreach ($livres as $livre)
                    
                    <div class="book-card bg-white rounded-lg shadow-md overflow-hidden transition-all">
                        <div class="h-48 primary-color flex items-center justify-center relative">
                            <div class="text-4xl text-white">📖</div>
                            
                        </div>
                    </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1">{{$livre->nom}}</h3>
                            <p class="text-gray-600 text-sm mb-2">{{$livre->auteur}}</p>
                            <div class="like-dislike-container">
                                <div class="like-count">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M1 21h4V9H1v12zm22-11c0-1.1-.9-2-2-2h-6.31l.95-4.57.03-.32c0-.41-.17-.79-.44-1.06L14.17 1 7.59 7.59C7.22 7.95 7 8.45 7 9v10c0 1.1.9 2 2 2h9c.83 0 1.54-.5 1.84-1.22l3.02-7.05c.09-.23.14-.47.14-.73v-2z"/>
                                    </svg>
                                    <span>{{$livre->like}}</span>
                                </div>
                                <div class="dislike-count">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M15 3H6c-.83 0-1.54.5-1.84 1.22l-3.02 7.05c-.09.23-.14.47-.14.73v2c0 1.1.9 2 2 2h6.31l-.95 4.57-.03.32c0 .41.17.79.44 1.06L9.83 23l6.59-6.59c.36-.36.58-.86.58-1.41V5c0-1.1-.9-2-2-2zm4 0v12h4V3h-4z"/>
                                    </svg>
                                    <span>{{$livre->dislike}}</span>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="font-bold text-primary text-lg">{{$livre->prix}}</span> 
                                </div>
                                <button class="btn-primary p-2 rounded-full transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
            </div>

                   
                <!-- Pagination -->
                <div class="flex justify-center">
                    <nav class="flex items-center space-x-2">
                        <button class="p-2 rounded-md border border-gray-300 hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button class="p-2 px-3 rounded-md border border-gray-300 pagination-active">1</button>
                        <button class="p-2 px-3 rounded-md border border-gray-300 hover:bg-gray-100">2</button>
                        <button class="p-2 px-3 rounded-md border border-gray-300 hover:bg-gray-100">3</button>
                        <button class="p-2 px-3 rounded-md border border-gray-300 hover:bg-gray-100">4</button>
                        <button class="p-2 rounded-md border border-gray-300 hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Newsletter Section -->
    <section class="py-16 primary-color text-white mt-12">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold heading-font mb-4">Join Our Reading Community</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">Subscribe to our newsletter for book recommendations, author events, and exclusive discounts.</p>
            
            <div class="max-w-md mx-auto flex">
                <input type="email" placeholder="Your email address" class="flex-grow px-4 py-3 rounded-l-md focus:outline-none text-third">
                <button class="btn-secondary font-medium px-6 py-3 rounded-r-md transition-colors">
                    Subscribe
                </button>
            </div>
        </div>
    </section>
        
        
    

@endsection

