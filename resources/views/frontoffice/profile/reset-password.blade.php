@extends('layouts.user')

@section('title', 'Leaf Village - Changer le Mot de Passe')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-green-50 to-emerald-100 py-8">
    <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-green-800 mb-2">Changer le Mot de Passe</h1>
            <p class="text-green-600">Mettez à jour votre mot de passe</p>
        </div>

        <!-- Password Reset Card -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-green-200">
            <div class="bg-emerald-600 h-2"></div>
            
            <div class="p-6 md:p-8">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-6">
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-green-700 mb-2">
                                Mot de Passe Actuel
                            </label>
                            <input 
                                type="password" 
                                id="current_password" 
                                name="current_password" 
                                class="w-full px-4 py-3 border border-green-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition duration-200"
                                autocomplete="current-password"
                            >
                            @error('current_password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="new_password" class="block text-sm font-medium text-green-700 mb-2">
                                Nouveau Mot de Passe
                            </label>
                            <input 
                                type="password" 
                                id="new_password" 
                                name="new_password" 
                                class="w-full px-4 py-3 border border-green-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition duration-200"
                                autocomplete="new-password"
                            >
                            <p class="text-xs text-gray-500 mt-2">Le mot de passe doit contenir au moins 8 caractères</p>
                            @error('new_password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="new_password_confirmation" class="block text-sm font-medium text-green-700 mb-2">
                                Confirmer le Nouveau Mot de Passe
                            </label>
                            <input 
                                type="password" 
                                id="new_password_confirmation" 
                                name="new_password_confirmation" 
                                class="w-full px-4 py-3 border border-green-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition duration-200"
                                autocomplete="new-password"
                            >
                        </div>
                    </div>
                    
                    <div class="mt-8 flex gap-4">
                        <a 
                            href="{{ route('profile') }}"
                            class="flex-1 bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-medium transition duration-200 text-center"
                        >
                            Retour
                        </a>
                        <button 
                            type="submit"
                            class="flex-1 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition duration-200 transform hover:scale-105"
                        >
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Security Tips -->
        <div class="mt-6 bg-blue-50 rounded-xl p-4 border border-blue-200">
            <h3 class="font-semibold text-blue-800 mb-2 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
                Conseils de sécurité
            </h3>
            <ul class="text-sm text-blue-600 list-disc list-inside space-y-1">
                <li>Utilisez un mot de passe unique</li>
                <li>Combinez lettres, chiffres et caractères spéciaux</li>
                <li>Évitez les informations personnelles évidentes</li>
            </ul>
        </div>
    </div>
</div>
@endsection