@extends('layouts.livre')

@section('title', 'Boutique')

@section('hero-section')                         
 <div class="md:w-1/2 mb-10 md:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold heading-font text-third mb-6">Discover Your Next Favorite Book</h1>
                    <p class="text-xl text-third mb-8 opacity-90">Kodama brings you a carefully curated collection of books for every reader. Find your next adventure in our forest of stories.</p>
                    <div class="flex space-x-4">
                        <button class="btn-primary px-6 py-3 rounded-md font-medium transition-colors">
                            Browse Collection
                        </button>
                    </div>
                </div>
                <div class="md:w-1/2 flex justify-center">
                    <div class="relative">
                        <div class="w-64 h-80 third-color rounded-lg shadow-xl transform rotate-3"></div>
                        <div class="w-64 h-80 bg-white border-2 border-primary rounded-lg shadow-xl absolute top-4 left-4 transform -rotate-2 flex items-center justify-center">
                            <div class="text-center p-6">
                                <img class="w-20 justify-self-center" src="{{ asset('img/logo.png') }}" alt="logo">
                                <p class="text-primary mt-2">Where stories grow</p>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
