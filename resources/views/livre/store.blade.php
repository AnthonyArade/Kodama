@extends('layouts.livre')

@section('title', 'Boutique')

@section('hero-section')
    <h1 class="text-4xl font-bold heading-font text-third text-center mb-4">Our Book Collection</h1>
    <p class="text-xl text-third text-center max-w-3xl mx-auto">Discover thousands of books across all genres. Find your next
        great read in our carefully curated collection.</p>
@endsection

@section('content')
    <!-- Breadcrumb -->
    @php
        $breadcrumbItems = [['name' => 'Home', 'url' => route('livres.index')], ['name' => 'Books']];

        if (Route::is('livresByCategory')) {
            // Make 'Books' clickable
            $breadcrumbItems[1]['url'] = route('livres');

            // Add the category as the last breadcrumb item
            $breadcrumbItems[] = ['name' => $livres[0]->category->nom];
        }
    @endphp

    <x-breadcrumb :items="$breadcrumbItems" />

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Filters Sidebar -->
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
                            <input type="text" placeholder="Title, author, keyword..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute right-3 top-2.5"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="mb-6">
                        <h3 class="font-bold mb-3">Categories</h3>
                        <div class="space-y-2">
                            @foreach ($categories as $category )
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded text-primary focus:ring-primary">
                                <span class="ml-2">{{$category->icon}} - {{  $category->nom }}</span>
                            </label>
                            @endforeach
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
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                    <p class="text-gray-600 mb-4 md:mb-0">Showing {{ $livres->firstItem() }}-{{ $livres->lastItem() }}
                        of {{ $livres->total() }} results</p>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center">
                            <span class="mr-2 text-gray-600">Sort by:</span>
                            <select
                                class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                <option>Featured</option>
                                <option>Newest</option>
                                <option>Price: Low to High</option>
                                <option>Price: High to Low</option>
                                <option>Most Liked</option>
                                <option>Most Popular</option>
                            </select>
                        </div>
                        <div class="flex border border-gray-300 rounded-md overflow-hidden">
                            <button type="button" class="view-toggle p-2 bg-gray-100 border-r border-gray-300"
                                data-view="list">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                </svg>
                            </button>
                            <button type="button" class="view-toggle p-2" data-view="grid">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Books Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8" id="books-container">
                    @forelse ($livres as $livre)
                        <div class="book-card bg-white rounded-lg shadow-md overflow-hidden transition-all">
                            <div class="h-48 primary-color flex items-center justify-center relative overflow-hidden">
                                @if ($livre->image)
                                    <img src="{{ $livre->image }}" alt="Image de {{ $livre->nom }}"
                                        class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                                @else
                                    <div
                                        class="text-4xl text-white bg-gray-300 w-full h-full flex items-center justify-center">
                                        📖
                                    </div>
                                @endif
                            </div>

                            <div class="p-4">
                                <h3 class="font-bold text-lg mb-1">{{ $livre->nom }}</h3>
                                <p class="text-gray-600 text-sm mb-2">{{ $livre->auteur }}</p>
                                <div class="flex items-center mb-2">
                                    @if ($livre->categorie)
                                        <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">
                                            {{ $livre->categorie->nom }}
                                        </span>
                                    @endif
                                </div>
                                <div class="like-dislike-container">
                                    <div class="like-count">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M1 21h4V9H1v12zm22-11c0-1.1-.9-2-2-2h-6.31l.95-4.57.03-.32c0-.41-.17-.79-.44-1.06L14.17 1 7.59 7.59C7.22 7.95 7 8.45 7 9v10c0 1.1.9 2 2 2h9c.83 0 1.54-.5 1.84-1.22l3.02-7.05c.09-.23.14-.47.14-.73v-2z" />
                                        </svg>
                                        <span>{{ $livre->like ?? 0 }}</span>
                                    </div>
                                    <div class="dislike-count">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M15 3H6c-.83 0-1.54.5-1.84 1.22l-3.02 7.05c-.09.23-.14.47-.14.73v2c0 1.1.9 2 2 2h6.31l-.95 4.57-.03.32c0 .41.17.79.44 1.06L9.83 23l6.59-6.59c.36-.36.58-.86.58-1.41V5c0-1.1-.9-2-2-2zm4 0v12h4V3h-4z" />
                                        </svg>
                                        <span>{{ $livre->unlike ?? 0 }}</span>
                                    </div>
                                </div>

                                <div class="flex justify-between items-center mt-3">
                                    <div>
                                        <span
                                            class="font-bold text-primary text-lg">${{ number_format($livre->prix, 2) }}</span>
                                    </div>
                                    @auth
                                        <form action="{{ route('panier.store', $livre->id) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            <button class="btn-primary p-2 hover:bg-blue-600 rounded-full transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('login') }}" class="">
                                            <button class="btn-primary p-2 hover:bg-blue-600 rounded-full transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                            </button>
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <p class="text-gray-500 text-lg">No books found matching your criteria.</p>
                            <p class="text-primary hover:underline mt-2 inline-block">Clear filters
                            </p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if ($livres->hasPages())
                    <div class="flex justify-center">
                        <nav class="flex items-center space-x-2">
                            {{-- Previous Page Link --}}
                            @if ($livres->onFirstPage())
                                <span class="p-2 rounded-md border border-gray-300 text-gray-400 cursor-not-allowed">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 19l-7-7 7-7" />
                                    </svg>
                                </span>
                            @else
                                <a href="{{ $livres->previousPageUrl() }}"
                                    class="p-2 rounded-md border border-gray-300 hover:bg-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 19l-7-7 7-7" />
                                    </svg>
                                </a>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($livres->links()->elements as $element)
                                @if (is_string($element))
                                    <span class="px-3 py-1">{{ $element }}</span>
                                @endif
                                @if (is_array($element))
                                    @foreach ($element as $page => $url)
                                        @if ($page == $livres->currentPage())
                                            <span
                                                class="p-2 px-3 rounded-md border border-gray-300 pagination-active">{{ $page }}</span>
                                        @else
                                            <a href="{{ $url }}"
                                                class="p-2 px-3 rounded-md border border-gray-300 hover:bg-gray-100">{{ $page }}</a>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($livres->hasMorePages())
                                <a href="{{ $livres->nextPageUrl() }}"
                                    class="p-2 rounded-md border border-gray-300 hover:bg-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            @else
                                <span class="p-2 rounded-md border border-gray-300 text-gray-400 cursor-not-allowed">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </span>
                            @endif
                        </nav>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
