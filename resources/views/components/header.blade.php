<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-third">
    <header class="bg-white shadow-sm sticky top-0 z-10">
        <header class="bg-white shadow-sm sticky top-0 z-10">
            <div class="container mx-auto px-4 py-4">
                <div class="flex justify-between items-center">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <img class="w-20" src="{{ asset('img/logo.png') }}" alt="logo">
                        <span class="text-sm text-gray-500 ml-2">Book Store</span>
                    </div>

                    <!-- Desktop Navigation (hidden on mobile) -->
                    <nav class="desktop-nav hidden md:flex space-x-8">
                        <a href="#" class="font-medium hover:text-primary transition-colors">Home</a>

                        <!-- Books with Dropdown -->
                        <div class="dropdown relative">
                            <button class="font-medium hover:text-primary transition-colors flex items-center gap-1">
                                Books
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="dropdown-menu">
                                <a href="#" class="dropdown-item">Fiction</a>
                                <a href="#" class="dropdown-item">Mystery & Thriller</a>
                                <a href="#" class="dropdown-item">Science Fiction</a>
                                <a href="#" class="dropdown-item">Romance</a>
                                <a href="#" class="dropdown-item">Fantasy</a>
                                <a href="#" class="dropdown-item">Non-Fiction</a>
                                <a href="#" class="dropdown-item">Biography</a>
                                <a href="#" class="dropdown-item">Children's Books</a>
                            </div>
                        </div>
                    </nav>

                    <!-- User Actions -->
                    <div class="flex items-center space-x-4">
                        <!-- Shop/Cart Icon -->
                        <a href="#" class="cart-icon relative p-2 rounded-full transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <div class="cart-badge">3</div>
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
                    <a href="#" class="mobile-menu-item">Home</a>

                    <!-- Books with Mobile Dropdown -->
                    <div class="mobile-dropdown">
                        <button class="mobile-menu-item w-full text-left flex justify-between items-center"
                            id="mobileBooksToggle">
                            Books
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform"
                                id="mobileBooksArrow" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="mobile-dropdown-menu" id="mobileBooksMenu">
                            <a href="#" class="mobile-menu-item">Fiction</a>
                            <a href="#" class="mobile-menu-item">Mystery & Thriller</a>
                            <a href="#" class="mobile-menu-item">Science Fiction</a>
                            <a href="#" class="mobile-menu-item">Romance</a>
                            <a href="#" class="mobile-menu-item">Fantasy</a>
                            <a href="#" class="mobile-menu-item">Non-Fiction</a>
                            <a href="#" class="mobile-menu-item">Biography</a>
                            <a href="#" class="mobile-menu-item">Children's Books</a>
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
                                </div>
                            <div class="px-4 py-2 mt-2 mb-2 space-y-2">        
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}">
                                        <button class="w-full btn-outline px-4 py-2 rounded-md transition-colors">
                                            Register
                                        </button>
                                    </a>
                                @endif
                            </div>
                        @endauth
                    @endif
                </div>
            </div>
        </header>

        <script>
            // Mobile menu functionality
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const mobileMenu = document.getElementById('mobileMenu');
            const mobileBooksToggle = document.getElementById('mobileBooksToggle');
            const mobileBooksMenu = document.getElementById('mobileBooksMenu');
            const mobileBooksArrow = document.getElementById('mobileBooksArrow');

            // Toggle mobile menu
            mobileMenuToggle.addEventListener('click', function() {
                mobileMenuToggle.classList.toggle('active');
                mobileMenu.classList.toggle('active');
            });

            // Toggle books dropdown in mobile menu
            mobileBooksToggle.addEventListener('click', function() {
                mobileBooksMenu.classList.toggle('active');
                mobileBooksArrow.classList.toggle('rotate-180');
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(event) {
                const isClickInsideMenu = mobileMenu.contains(event.target);
                const isClickOnToggle = mobileMenuToggle.contains(event.target);

                if (!isClickInsideMenu && !isClickOnToggle && mobileMenu.classList.contains('active')) {
                    mobileMenu.classList.remove('active');
                    mobileMenuToggle.classList.remove('active');
                    mobileBooksMenu.classList.remove('active');
                    mobileBooksArrow.classList.remove('rotate-180');
                }
            });
        </script>
