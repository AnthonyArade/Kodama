<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Définition de l'encodage et du viewport pour le responsive -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Jeton CSRF pour sécuriser les formulaires -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Titre dynamique de la page, récupéré depuis les sections des vues -->
    <title>@yield('title', 'My Website')</title>

    <!-- Préconnexion et import de la police Instrument Sans depuis Bunny Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Inclusion des fichiers CSS et JS générés par Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-third">

<!-- Affichage des messages de succès, si présents dans la session -->
@if (session('success'))
    <div class="bg-green-500 text-white p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<!-- Affichage des messages d'erreur, si présents dans la session -->
@if (session('error'))
    <div class="bg-red-500 text-white p-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

<!-- Inclusion du header avec la liste des catégories passée en variable -->
<x-header :categories="$categories" />

<x-promo-banner/>

<!-- Section héroïque avec couleur secondaire et padding vertical -->
<section class="secondary-color py-16">
    <div class="container mx-auto px-4 text-center">
        <!-- Contenu spécifique à chaque page inséré ici -->
        @yield('hero-section')
    </div>
</section>

<!-- Contenu principal de la page injecté depuis les vues -->
@yield('content')

<!-- Inclusion du footer -->
<x-footer/>

</body>
</html>
