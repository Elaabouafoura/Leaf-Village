@extends('layouts.user')

@section('title', 'Liste des Partenaires')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Our Valued Partners</h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Collaborating with leading organizations to create sustainable green spaces and build better communities together.
            </p>
        </div>

        <!-- Partners Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @forelse($partenaires as $partenaire)
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 p-6 border border-gray-100">
                    <!-- Partner Header -->
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <h3 class="font-bold text-xl text-gray-900 mb-2">{{ $partenaire->nom }}</h3>
                            <div class="flex items-center gap-2 mb-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                    {{ $partenaire->type === 'Corporate' ? 'bg-blue-100 text-blue-800' : 
                                       ($partenaire->type === 'Government' ? 'bg-green-100 text-green-800' : 
                                       ($partenaire->type === 'NGO' ? 'bg-purple-100 text-purple-800' : 
                                       'bg-orange-100 text-orange-800')) }}">
                                    {{ $partenaire->type }}
                                </span>
                            </div>
                        </div>
                        <!-- Partner Icon -->
                        <div class="ml-4 p-3 bg-green-50 rounded-xl">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div class="flex items-center text-gray-600 mb-6">
                        <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span class="text-sm truncate">{{ $partenaire->contact }}</span>
                    </div>

                    <!-- Financing Section -->
                    <div class="border-t pt-4">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="font-semibold text-gray-900">Financial Contributions</h4>
                            @if($partenaire->financements->count())
                                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full font-medium">
                                    {{ $partenaire->financements->count() }} active
                                </span>
                            @endif
                        </div>

                        @if($partenaire->financements->count())
                            <div class="space-y-3">
                                @foreach($partenaire->financements as $financement)
                                    <div class="bg-gray-50 rounded-lg p-4 hover:bg-gray-100 transition-colors duration-200">
                                        <div class="flex justify-between items-start mb-2">
                                            <span class="font-bold text-lg text-green-700">
                                                {{ number_format($financement->montant, 0, ',', ' ') }} €
                                            </span>
                                           
                                        </div>
                                        <div class="flex justify-between text-xs text-gray-500">
                                            <span>From: {{ \Carbon\Carbon::parse($financement->dateDebut)->format('M Y') }}</span>
                                            <span>To: {{ \Carbon\Carbon::parse($financement->dateFin)->format('M Y') }}</span>
                                        </div>
                                        <!-- Progress bar -->
                                        @php
                                            $totalMonths = \Carbon\Carbon::parse($financement->dateDebut)->diffInMonths($financement->dateFin);
                                            $elapsedMonths = \Carbon\Carbon::parse($financement->dateDebut)->diffInMonths(now());
                                            $progress = min(100, max(0, ($elapsedMonths / $totalMonths) * 100));
                                        @endphp
                                        <div class="mt-2">
                                            <div class="w-full bg-gray-200 rounded-full h-2">
                                                <div class="bg-green-600 h-2 rounded-full" style="width: {{ $progress }}%"></div>
                                            </div>
                                           
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-6">
                                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                </svg>
                                <p class="text-gray-400 text-sm">No active funding at the moment</p>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <!-- Empty State -->
                <div class="col-span-3 text-center py-16">
                    <div class="max-w-md mx-auto">
                        <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <h3 class="text-2xl font-bold text-gray-400 mb-2">No Partners Found</h3>
                        <p class="text-gray-500 mb-6">We're currently building our network of partners. Check back soon!</p>
                        <button class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                            Become a Partner
                        </button>
                    </div>
                </div>
            @endforelse
        </div>

        

        <!-- Call to Action -->
        <div class="text-center bg-gradient-to-r from-green-500 to-green-600 rounded-2xl p-12 text-white">
            <h2 class="text-3xl font-bold mb-4">Want to Become a Partner?</h2>
            <p class="text-green-100 text-xl mb-8 max-w-2xl mx-auto">
                Join our network of organizations committed to creating sustainable green spaces and making a positive environmental impact.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button class="bg-white text-green-600 hover:bg-green-50 px-8 py-3 rounded-lg font-semibold transition-colors duration-200">
                    Contact Us
                </button>
                <button class="border-2 border-white text-white hover:bg-white hover:text-green-600 px-8 py-3 rounded-lg font-semibold transition-colors duration-200">
                    Learn More
                </button>
            </div>
        </div>
    </div>
</div>
@endsection