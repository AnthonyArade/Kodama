@props(['categories' => []])

<header class="bg-white shadow-sm sticky top-0 z-10">
    <div class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center">

            <!-- Logo -->
            <div class="flex items-center">
                <img class="w-20" src="{{ asset('img/logo.png') }}" alt="logo">
                <span class="text-sm text-gray-500 ml-2">Book Store</span>
            </div>

            <!-- Desktop Navigation -->
            <nav class="desktop-nav hidden md:flex space-x-8">
                <a href="{{ route('livres.index') }}" class="font-medium hover:text-primary transition-colors">Home</a>

                <!-- Books with Dropdown -->
                <div class="dropdown relative">
                    <a href="{{ route('livres') }}">
                        <button class="font-medium hover:text-primary transition-colors flex items-center gap-1">
                            Books
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </a>
                    <div class="dropdown-menu">
                        @foreach ($categories as $category)
                            <a href="{{ route('livresByCategory',$category->id) }}" class="dropdown-item">
                                {{ $category->nom }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </nav>

            <!-- User Actions -->
            <div class="flex items-center space-x-4">
                <!-- Shop/Cart Icon -->
                <a href="{{ route('cart.index') }}" class="cart-icon relative p-2 rounded-full transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <div class="cart-badge">{{ $cart->count() }}</div>
                </a>

                <!-- Desktop Sign In Button -->
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}">
                            <button class="sign-in-btn btn-primary px-4 py-2 rounded-md transition-colors">
                                Sign In
                            </button>
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">
                                <button class="sign-in-btn btn-outline px-4 py-2 rounded-md transition-colors">
                                    Register
                                </button>
                            </a>
                        @endif
                    @endauth
                @endif

                <!-- Mobile Menu Toggle -->
                <div class="hamburger" id="mobileMenuToggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="mobile-menu" id="mobileMenu">
            <a href="{{ route('livres.index') }}" class="mobile-menu-item">Home</a>

            <!-- Books with Mobile Dropdown -->
            <div class="mobile-dropdown">
                <a href="{{ route('livres') }}">
                    <button class="mobile-menu-item w-full text-left flex justify-between items-center"
                        id="mobileBooksToggle">
                        Books
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform"
                            id="mobileBooksArrow" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </a>
                <div class="mobile-dropdown-menu" id="mobileBooksMenu">
                    @foreach ($categories as $category)
                        <a href="" class="mobile-menu-item">
                            {{ $category->nom }}
                        </a>
                    @endforeach
                </div>

            </div>

            <!-- Mobile Sign In Button -->
            @if (Route::has('login'))
                @auth
                    <div class="px-4 py-2 mt-2">
                        <a href="{{ url('/dashboard') }}" class="mobile-menu-item">
                            Dashboard
                        </a>
                    </div>
                @else
                    <div class="px-4 py-2 mt-2 mb-2 space-y-2">
                        <a href="{{ route('login') }}">
                            <button class="w-full btn-primary px-4 py-2 rounded-md transition-colors">
                                Sign In
                            </button>
                        </a>
                @endif
                @endif
            </div>
        </div>
    </header>
