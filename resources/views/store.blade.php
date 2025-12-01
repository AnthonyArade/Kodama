@extends('layouts.livre')

@section('title', 'Boutique')

@section('hero-section')
            <h1 class="text-4xl font-bold heading-font text-third text-center mb-4">Our Book Collection</h1>
            <p class="text-xl text-third text-center max-w-3xl mx-auto">Discover thousands of books across all genres. Find your next great read in our carefully curated collection.</p>
@endsection

@section('content')
    <!-- Breadcrumb -->
    <x-breadcrumb :items="[['name' => 'Home']]" />

@endsection
