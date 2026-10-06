@extends('layouts.user')

@section('title', 'Leaf Village - Mon Profil')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-green-50 to-emerald-100 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-green-800 mb-2">Mon Profil</h1>
            <p class="text-lg text-green-600">Gérez vos informations personnelles</p>
        </div>

        <!-- Profile Card -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-green-200">
            <div class="bg-green-600 h-2"></div>
            
            <div class="p-6 md:p-8">
                <!-- Profile Information -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left Column - Personal Info -->
                    <div class="lg:col-span-2">
                        <h2 class="text-2xl font-semibold text-green-800 mb-6">Informations Personnelles</h2>
                        
                        <div class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-green-700 mb-1">Nom</label>
                                    <div class="w-full px-4 py-2 bg-green-50 border border-green-200 rounded-lg text-green-900">
                                        {{ auth()->user()->nom }}
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-green-700 mb-1">Prénom</label>
                                    <div class="w-full px-4 py-2 bg-green-50 border border-green-200 rounded-lg text-green-900">
                                        {{ auth()->user()->prenom }}
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-green-700 mb-1">Email</label>
                                <div class="w-full px-4 py-2 bg-green-50 border border-green-200 rounded-lg text-green-900">
                                    {{ auth()->user()->email }}
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-green-700 mb-1">Téléphone</label>
                                    <div class="w-full px-4 py-2 bg-green-50 border border-green-200 rounded-lg text-green-900">
                                        {{ auth()->user()->telephone ?? 'Non renseigné' }}
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-green-700 mb-1">Rôle</label>
                                    <div class="w-full px-4 py-2 bg-green-50 border border-green-200 rounded-lg text-green-900 capitalize">
                                        {{ auth()->user()->role }}
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-green-700 mb-1">Date d'inscription</label>
                                <div class="w-full px-4 py-2 bg-green-50 border border-green-200 rounded-lg text-green-900">
                                    {{ \Carbon\Carbon::parse(auth()->user()->dateInscription)->format('d/m/Y') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column - Stats -->
                    <div class="lg:col-span-1">
                        <h2 class="text-2xl font-semibold text-green-800 mb-6">Mes Statistiques</h2>
                        
                        <div class="space-y-4">
                            <div class="bg-green-50 rounded-xl p-4 border border-green-200">
                                <div class="flex items-center justify-between">
                                    <span class="text-green-700 font-medium">Activités</span>
                                    <span class="bg-green-600 text-white px-3 py-1 rounded-full text-sm font-bold">
                                        {{ auth()->user()->activites->count() }}
                                    </span>
                                </div>
                                <p class="text-green-600 text-sm mt-2">Activités participées</p>
                            </div>
                            
                            <div class="bg-green-50 rounded-xl p-4 border border-emerald-200">
                                <div class="flex items-center justify-between">
                                    <span class="text-green-700 font-medium">Événements</span>
                                    <span class="bg-green-600 text-white px-3 py-1 rounded-full text-sm font-bold">
                                        {{ auth()->user()->evenements->count() }}
                                    </span>
                                </div>
                                <p class="text-green-600 text-sm mt-2">Événements suivis</p>
                            </div>
                            
                            <div class="bg-green-50 rounded-xl p-4 border border-teal-200">
                                <div class="flex items-center justify-between">
                                    <span class="text-green-700 font-medium">Avis</span>
                                    <span class="bg-green-600 text-white px-3 py-1 rounded-full text-sm font-bold">
                                        {{ auth()->user()->feedbacks->count() }}
                                    </span>
                                </div>
                                <p class="text-green-600 text-sm mt-2">Feedbacks partagés</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Double Action Buttons -->
                <div class="mt-8 pt-6 border-t border-green-200 flex justify-center gap-6">
                    <!-- Update Profile Button -->
                    <a 
                        href="{{ route('user.profile.showUpdate') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-lg font-medium transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-50 inline-flex items-center"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M11 17h2v2h-2v-2zm-6.586-7.414l8.485 8.485a2 2 0 002.828 0l4.243-4.243a2 2 0 000-2.828L13.828 2.758a2 2 0 00-2.828 0L6.757 7.999a2 2 0 000 2.828z"/>
                        </svg>
                        Modifier le Profil
                    </a>

                    <!-- Change Password Button -->
                    <a 
                        href="{{ route('reset.password') }}"
                        class="bg-green-500 hover:bg-green-600 text-white px-8 py-3 rounded-lg font-medium transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 inline-flex items-center"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                        </svg>
                        Changer le Mot de Passe
                    </a>
                </div>

            </div>
        </div>
        
        <!-- Recent Activities Section -->
        <div class="mt-8 bg-white rounded-2xl shadow-lg border border-green-200 p-6">
            <h2 class="text-2xl font-semibold text-green-800 mb-6">Mes Activités Récentes</h2>
            
            @if(auth()->user()->activites->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach(auth()->user()->activites->take(3) as $activite)
                    <div class="bg-green-50 rounded-xl p-4 border border-green-200 hover:shadow-md transition duration-200">
                        <h3 class="font-semibold text-green-800 mb-2">{{ $activite->nom }}</h3>
                        <p class="text-green-600 text-sm">Participé le {{ $activite->pivot->created_at->format('d/m/Y') }}</p>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <div class="text-green-400 mb-4">
                        <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-green-600">Aucune activité participée pour le moment</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection