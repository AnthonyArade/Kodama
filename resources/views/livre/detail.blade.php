@extends('layouts.livre')

@section('title', 'Boutique')

@section('hero-section')
<h1 class="text-4xl font-bold heading-font text-third text-center mb-4">Titre du livre /h1>
<p class="text-xl text-third text-center max-w-3xl mx-auto">author</p>
@endsection

@section('content')
    <!-- Breadcrumb -->
    <x-breadcrumb :items="[['name' => 'Home']]" />

@endsection
