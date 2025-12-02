@extends('layouts.livre')

@section('title', 'Order Confirmation')

@section('hero-section')
    <!-- Animated Checkmark -->
    <svg class="checkmark mb-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
        <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
        <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
    </svg>

    <h1 class="text-5xl font-bold heading-font text-third mb-4">Order Confirmed!</h1>
    <p class="text-xl text-third max-w-2xl mx-auto mb-6">Thank you for your purchase. Your order has been successfully placed and is being processed.</p>

    <div class="inline-flex items-center gap-4">
        <span class="order-status order-status-processing">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Processing
        </span>
        <span class="text-gray-600">Order #KDM-{{ $command->id }}</span>
    </div>
@endsection

@section('content')
    <!-- Breadcrumb -->
    <x-breadcrumb :items="[['name' => 'Home', 'url' => route('livres.index')], ['name' => 'Order']]" />

    <!-- Order Details Section -->
    <section class="py-8 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Order Summary -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                        <h2 class="text-2xl font-bold heading-font mb-6">Order Details</h2>

                        <!-- Order Items -->
                        <div class="space-y-6 mb-8">
                            @foreach ($command->ligne as $ligne)
                                <!-- Order Item -->
                                <div class="flex flex-col sm:flex-row gap-4 p-4 border border-gray-200 rounded-lg">
                                    <div class="w-20 h-28 primary-color rounded flex items-center justify-center flex-shrink-0">
                                        <img src="{{ $ligne->livre->image }}" alt="">
                                    </div>
                                    <div class="flex-grow">
                                        <div class="flex justify-between">
                                            <div>
                                                <h3 class="font-bold">{{ $ligne->livre->nom }}</h3>
                                                <p class="text-gray-600">{{ $ligne->livre->auteur }}</p>
                                            </div>
                                            <div class="text-right">
                                                <p class="font-bold text-primary">{{ $ligne->livre->prix }}€</p>
                                                <p class="text-sm text-gray-500">Qty: {{ $ligne->quantite }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Order Timeline -->
                        <div>
                            <h3 class="font-bold text-lg mb-4">Order Timeline</h3>
                            <div class="space-y-4">
                                <div class="flex items-start gap-3">
                                    <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium">Order Placed</p>
                                        <p class="text-sm text-gray-600">Just now</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                    <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-500">Processing</p>
                                        <p class="text-sm text-gray-500">Estimated: Today</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                    <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-500">Shipped</p>
                                        <p class="text-sm text-gray-500">Estimated: Within 2-3 business days</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                    <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-500">Delivered</p>
                                        <p class="text-sm text-gray-500">Estimated: 5-7 business days</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Information & Actions -->
                <div class="space-y-6">
                    <!-- Order Summary Card -->
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <h3 class="font-bold text-lg mb-4">Order Summary</h3>
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal ({{ $command->ligne->sum('quantite') }} item(s))</span>
                                <span class="font-medium">{{ number_format($command->total, 2) }}€</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Shipping</span>
                                <span class="font-medium text-green-600">9.99€</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tax</span>
                                <span class="font-medium">4.80€</span>
                            </div>
                            <div class="border-t border-gray-200 pt-3">
                                <div class="flex justify-between text-lg font-bold">
                                    <span>Total</span>
                                    <span>{{ number_format($command->total + 9.99 + 4.80, 2) }}€</span>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Payment Method</span>
                                <span class="font-medium">Credit Card •••• 4242</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Shipping Method</span>
                                <span class="font-medium">Standard Shipping</span>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Information -->
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <h3 class="font-bold text-lg mb-4">Shipping Information</h3>
                        <div class="space-y-2">
                            <p class="font-medium">{{ $command->user->name }}</p>
                            <p class="text-gray-600">123 Bookworm Lane</p>
                            <p class="text-gray-600">Reading City, RC 12345</p>
                            <p class="text-gray-600">United States</p>
                            <p class="text-gray-600">{{ $command->user->email }}</p>
                            <p class="text-gray-600">(555) 123-4567</p>
                        </div>
                    </div>

                    <!-- Order Actions -->
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <h3 class="font-bold text-lg mb-4">Order Actions</h3>
                        <div class="space-y-3">
                            <button class="w-full btn-outline py-3 rounded-lg font-medium transition-colors flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Download Invoice
                            </button>
                            <button class="w-full btn-outline py-3 rounded-lg font-medium transition-colors flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                                Contact Support
                            </button>
                            <a href="#" class="block text-center text-primary hover:text-primary-dark transition-colors">
                                Track Your Order
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Continue Shopping -->
            <div class="text-center mt-8">
                <a href="{{ route('livres.index') }}" class="btn-primary inline-flex items-center gap-2 px-8 py-3 rounded-lg font-medium text-lg transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Continue Shopping
                </a>
            </div>
        </div>
    </section>
@endsection