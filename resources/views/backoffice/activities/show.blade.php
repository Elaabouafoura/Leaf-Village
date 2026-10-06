@extends('layouts.admin')

@section('title', 'Détails de l’Activité')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-emerald-50 via-white to-teal-50/30 py-8">
    <div class="container mx-auto px-4 max-w-6xl">
        <!-- Header Section -->
        <div class="text-center mb-8" data-aos="fade-up">
            <div class="inline-flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-emerald-100 rounded-2xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <h1 class="text-4xl font-bold text-gray-900">Détails de l'Activité</h1>
            </div>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Consultez les informations détaillées de votre activité et les retours des participants
            </p>
        </div>

        <!-- Activity Card -->
        <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl border border-emerald-100/50 mb-8 transition-all duration-300 hover:shadow-2xl" data-aos="fade-up">
            <div class="bg-gradient-to-r from-emerald-600 to-teal-600 rounded-t-3xl p-6">
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-white mb-1">{{ $activity->nom }}</h2>
                            <p class="text-emerald-100 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ $activity->date ? \Carbon\Carbon::parse($activity->date)->format('d M Y') : 'Date non spécifiée' }}
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('activities.index') }}" class="group bg-white/20 hover:bg-white/30 text-white px-6 py-3 rounded-2xl font-semibold transition-all duration-300 backdrop-blur-sm flex items-center gap-2">
                        <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Retour à la liste
                    </a>
                </div>
            </div>

            <div class="p-8">
                <!-- Description -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Description
                    </h3>
                    <div class="bg-emerald-50/50 border border-emerald-100 rounded-2xl p-6">
                        <p class="text-gray-700 leading-relaxed">{{ $activity->description ?? 'Aucune description disponible' }}</p>
                    </div>
                </div>

                <!-- Activity Details Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Project Info -->
                    <div class="bg-white border border-gray-200 rounded-2xl p-6 transition-all duration-300 hover:border-emerald-200 hover:shadow-lg">
                        <h4 class="font-semibold text-gray-900 mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            Projet Associé
                        </h4>
                        <p class="text-lg font-medium text-emerald-700 bg-emerald-50 px-4 py-3 rounded-xl">
                            {{ $activity->projet?->nom ?? '— Aucun projet associé —' }}
                        </p>
                    </div>

                    <!-- Members Info -->
                    <div class="bg-white border border-gray-200 rounded-2xl p-6 transition-all duration-300 hover:border-emerald-200 hover:shadow-lg">
                        <h4 class="font-semibold text-gray-900 mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Membres Assignés
                        </h4>
                        @if($activity->members->isNotEmpty())
                            <div class="flex flex-wrap gap-2">
                                @foreach($activity->members as $member)
                                <span class="bg-emerald-100 text-emerald-800 px-3 py-2 rounded-xl text-sm font-medium flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    {{ $member->nom }}
                                </span>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 bg-gray-50 px-4 py-3 rounded-xl italic">
                                — Aucun membre assigné —
                            </p>
                        @endif
                    </div>
                </div>
                <!-- Resources Info -->
                <div class="bg-white border border-gray-200 rounded-2xl p-6 transition-all duration-300 hover:border-emerald-200 hover:shadow-lg">
                    <h4 class="font-semibold text-gray-900 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M12 8v8m-4-4h8m8 0A9 9 0 11-4 0a9 9 0 0118 0z" />
                        </svg>
                        Ressources Liées
                    </h4>

                    @if($activity->ressources->isNotEmpty())
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm border border-emerald-100 rounded-xl overflow-hidden">
                                <thead class="bg-emerald-600 text-white">
                                    <tr>
                                        <th class="px-4 py-3 text-left font-semibold">Nom</th>
                                        <th class="px-4 py-3 text-left font-semibold">Type</th>
                                        <th class="px-4 py-3 text-left font-semibold">Quantité</th>
                                        <th class="px-4 py-3 text-left font-semibold">Fournisseur</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-emerald-100 bg-white">
                                    @foreach($activity->ressources as $ressource)
                                        <tr class="hover:bg-emerald-50/50 transition">
                                            <td class="px-4 py-3 font-medium text-gray-900">{{ $ressource->nom }}</td>
                                            <td class="px-4 py-3 text-gray-700">{{ $ressource->type ?? '—' }}</td>
                                            <td class="px-4 py-3 text-gray-700">{{ $ressource->quantite ?? '—' }}</td>
                                            <td class="px-4 py-3 text-emerald-700 font-semibold">
                                                {{ $ressource->fournisseur?->nom ?? 'Non spécifié' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500 bg-gray-50 px-4 py-3 rounded-xl italic">
                            — Aucune ressource disponible pour cette activité —
                        </p>
                    @endif
                </div>

            </div>
        </div>

        <!-- Feedbacks Section -->
        <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl border border-emerald-100/50 transition-all duration-300 hover:shadow-2xl" data-aos="fade-up">
            <div class="border-b border-emerald-100/50 p-6">
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Feedbacks des Participants</h3>
                            <p class="text-gray-600 flex items-center gap-2">
                                {{ $activity->feedbacks->count() }} retour(s) reçu(s)
                            </p>
                        </div>
                    </div>
                    
                    <!-- Analysis Button -->
                    <button 
                        id="analysisButton"
                        onclick="openModal('feedbackAnalysisModal')"
                        data-bs-toggle="modal" 
                        data-bs-target="#feedbackAnalysisModal"
                        class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-xl hover:shadow-lg transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
                        {{ $activity->feedbacks->count() < 3 ? 'disabled' : '' }}
                        title="{{ $activity->feedbacks->count() < 3 ? 'Minimum 3 feedbacks requis pour l\'analyse' : 'Voir l\'analyse globale' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        Analyse Globale
                    </button>
                </div>
            </div>

            <div class="p-6">
                @if($activity->feedbacks->isEmpty())
                    <!-- Empty State -->
                    <div class="text-center py-12">
                        <div class="w-24 h-24 mx-auto mb-4 bg-emerald-50 rounded-3xl flex items-center justify-center">
                            <svg class="w-12 h-12 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Aucun feedback pour le moment</h4>
                        <p class="text-gray-600 max-w-md mx-auto">
                            Les participants n'ont pas encore partagé leurs retours sur cette activité.
                        </p>
                    </div>
                @else
                    <!-- Feedbacks List -->
                    <div class="space-y-6 max-h-[600px] overflow-y-auto pr-2 scrollbar-thin scrollbar-thumb-emerald-300 scrollbar-track-emerald-50">
                        @foreach($activity->feedbacks as $feedback)
                        <div class="group bg-gradient-to-r from-white to-emerald-50/30 border border-emerald-100 rounded-2xl p-6 transition-all duration-300 hover:shadow-lg hover:border-emerald-200">
                            <!-- Feedback Header -->
                            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-4 gap-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h5 class="font-semibold text-gray-900">{{ $feedback->user->nom.' '.$feedback->user->prenom ?? 'Utilisateur anonyme' }}</h5>
                                        <p class="text-sm text-gray-500 flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
                                            </svg>
                                            {{ $feedback->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                                
                                @if($feedback->note)
                                <div class="flex items-center gap-2 bg-yellow-50 px-3 py-2 rounded-xl">
                                    <div class="flex items-center gap-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $feedback->note)
                                                <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                            @else
                                                <svg class="w-4 h-4 text-gray-300 fill-current" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="text-sm font-semibold text-yellow-700">({{ $feedback->note }}/5)</span>
                                </div>
                                @endif
                            </div>

                            <!-- Comment -->
                            <div class="bg-white border border-gray-100 rounded-xl p-4">
                                <p class="text-gray-700 leading-relaxed">{{ $feedback->commentaire }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Floating Background Effects -->
    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-32 w-96 h-96 bg-emerald-200 rounded-full blur-3xl opacity-20 animate-float"></div>
        <div class="absolute -bottom-40 -left-32 w-96 h-96 bg-teal-200 rounded-full blur-3xl opacity-20 animate-float" style="animation-delay: 2s;"></div>
    </div>
</div>

<!-- Feedback Analysis Modal -->
<!-- Replace the entire custom modal with this x-modal component -->
@if(count($feedbackAnalysis)>0)
<x-modal 
    id="feedbackAnalysisModal" 
    title="Analyse des Feedbacks" 
    type="info" 
    size="modal-xl"
    subtitle="Synthèse des retours des participants sur cette activité">
    
    <div class="space-y-6">
        <!-- Overall Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Total Feedbacks -->
            <div class="bg-gradient-to-br from-emerald-50 to-teal-50 rounded-2xl p-4 text-center border border-emerald-100">
                <div class="text-2xl font-bold text-emerald-600">{{ $activity->feedbacks->count() }}</div>
                <div class="text-sm text-emerald-700 font-medium">Total Feedbacks</div>
            </div>
            
            <!-- Mean Rating -->
            <div class="bg-gradient-to-br from-amber-50 to-yellow-50 rounded-2xl p-4 text-center border border-amber-100">
                <div class="text-2xl font-bold text-amber-600">
                    {{ number_format($activity->feedbacks->avg('note'), 1) }}/5
                </div>
                <div class="text-sm text-amber-700 font-medium">Note Moyenne</div>
            </div>
            
            <!-- Rating Distribution -->
            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-4 text-center border border-green-100">
                <div class="text-2xl font-bold text-green-600">
                    {{ $activity->feedbacks->where('note', '>=', 4)->count() }}
                </div>
                <div class="text-sm text-green-700 font-medium">Positifs (4+ ⭐)</div>
            </div>
        </div>

        <!-- Overall Analysis -->
        <div class="bg-gradient-to-br from-emerald-50/50 to-teal-50/50 rounded-2xl p-6 border border-emerald-200">
            <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                <div class="w-8 h-8 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                Analyse Globale
            </h4>
            
            <!-- Mean Rating Section -->
            <div class="mb-4">
                <h5 class="font-semibold text-gray-800 mb-3 flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                    </svg>
                    Note Moyenne
                </h5>
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-1">
                        @php
                            $meanRating = $activity->feedbacks->avg('note');
                            $fullStars = floor($meanRating);
                            $hasHalfStar = $meanRating - $fullStars >= 0.5;
                        @endphp
                        
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $fullStars)
                                <svg class="w-6 h-6 text-amber-400 fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @elseif($hasHalfStar && $i == $fullStars + 1)
                                <svg class="w-6 h-6 text-amber-400 fill-current" viewBox="0 0 20 20">
                                    <defs>
                                        <linearGradient id="half-star">
                                            <stop offset="50%" stop-color="currentColor"/>
                                            <stop offset="50%" stop-color="transparent"/>
                                        </linearGradient>
                                    </defs>
                                    <path fill="url(#half-star)" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @else
                                <svg class="w-6 h-6 text-gray-300 fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endif
                        @endfor
                    </div>
                    <div>
                        <span class="text-xl font-bold text-gray-900">{{ number_format($meanRating, 1) }}/5</span>
                        <p class="text-sm text-gray-600 mt-1">
                            Basé sur {{ $activity->feedbacks->count() }} évaluation(s)
                        </p>
                    </div>
                </div>
            </div>

            <!-- Next Steps Section -->
            <div class="space-y-3">
                @if(isset($feedbackAnalysis))
                    {{-- Main message block --}}
                    @if($feedbackAnalysis['category'] === 'excellent')
                        <div class="flex items-start gap-3 p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl border border-green-200">
                            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center mt-0.5 flex-shrink-0">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-green-800">{{ $feedbackAnalysis['mainMessage'] }}</p>
                                <p class="text-sm text-green-700 mt-1">Note moyenne : {{ number_format($feedbackAnalysis['meanRating'], 1) }} ({{ $feedbackAnalysis['positivePercentage'] }}% positifs)</p>
                            </div>
                        </div>
                    @elseif($feedbackAnalysis['category'] === 'average')
                        <div class="flex items-start gap-3 p-4 bg-gradient-to-r from-amber-50 to-yellow-50 rounded-xl border border-amber-200">
                            <div class="w-8 h-8 bg-amber-500 rounded-full flex items-center justify-center mt-0.5 flex-shrink-0">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-amber-800">{{ $feedbackAnalysis['mainMessage'] }}</p>
                                <p class="text-sm text-amber-700 mt-1">Note moyenne : {{ number_format($feedbackAnalysis['meanRating'], 1) }} ({{ $feedbackAnalysis['positivePercentage'] }}% positifs)</p>
                            </div>
                        </div>
                    @else
                        <div class="flex items-start gap-3 p-4 bg-gradient-to-r from-red-50 to-orange-50 rounded-xl border border-red-200">
                            <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center mt-0.5 flex-shrink-0">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-red-800">{{ $feedbackAnalysis['mainMessage'] }}</p>
                                <p class="text-sm text-red-700 mt-1">Note moyenne : {{ number_format($feedbackAnalysis['meanRating'], 1) }} ({{ $feedbackAnalysis['positivePercentage'] }}% positifs)</p>
                            </div>
                        </div>
                    @endif

                    {{-- AI-generated recommendations --}}
                    @foreach($feedbackAnalysis['recommendations'] as  $index => $recommendation)
                        <div class="flex items-start gap-3 p-4 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl border border-blue-200">
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center mt-0.5 flex-shrink-0">
                                <span class="text-white text-sm font-bold">{{ $index + 1 }}</span>
                            </div>
                            <div>
                                <p class="font-semibold text-blue-800">Recommandation {{ $index + 1 }}</p>
                                <p class="text-sm text-blue-700 mt-1">{{ $recommendation }}</p>
                            </div>
                        </div>
                    @endforeach

                    {{-- Top keywords --}}
                    @if(!empty($feedbackAnalysis['topKeywords']))
                        <div class="flex items-start gap-3 p-4 bg-gradient-to-r from-teal-50 to-emerald-50 rounded-xl border border-teal-200">
                            <div class="w-8 h-8 bg-teal-500 rounded-full flex items-center justify-center mt-0.5 flex-shrink-0">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-teal-800">Mots-clés les plus fréquents</p>
                                <p class="text-sm text-teal-700 mt-1">{{ implode(', ', $feedbackAnalysis['topKeywords']) }}</p>
                            </div>
                        </div>
                    @endif
                @else
                    <p class="text-gray-500 text-sm italic">Analyse IA non disponible pour le moment.</p>
                @endif
            </div>

        </div>

        <!-- Quick Stats -->
        <div class="bg-gradient-to-br from-slate-50 to-gray-50 rounded-2xl p-5 border border-gray-200">
            <h5 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                Statistiques Détaillées
            </h5>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div class="flex justify-between items-center p-2 bg-white rounded-lg">
                    <span class="text-gray-600">Feedbacks 5 ⭐:</span>
                    <span class="font-semibold text-gray-900">{{ $activity->feedbacks->where('note', 5)->count() }}</span>
                </div>
                <div class="flex justify-between items-center p-2 bg-white rounded-lg">
                    <span class="text-gray-600">Feedbacks 1 ⭐:</span>
                    <span class="font-semibold text-gray-900">{{ $activity->feedbacks->where('note', 1)->count() }}</span>
                </div>
                <div class="flex justify-between items-center p-2 bg-white rounded-lg">
                    <span class="text-gray-600">Avec commentaires:</span>
                    <span class="font-semibold text-gray-900">{{ $activity->feedbacks->where('commentaire', '!=', '')->count() }}</span>
                </div>
                <div class="flex justify-between items-center p-2 bg-white rounded-lg">
                    <span class="text-gray-600">Sans commentaires:</span>
                    <span class="font-semibold text-gray-900">{{ $activity->feedbacks->where('commentaire', '')->count() }}</span>
                </div>
            </div>
        </div>
    </div>

    @slot('footer')
        <div class="flex gap-3 w-full">
            <button type="button" class="flex-1 px-6 py-3 text-gray-700 bg-gray-100 rounded-xl hover:bg-gray-200 transition-all duration-300 font-semibold shadow-sm" data-bs-dismiss="modal">
                Fermer
            </button>
            <button onclick="printAnalysis()" class="flex-1 px-6 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-xl hover:shadow-lg transition-all duration-300 font-semibold shadow-sm flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Exporter l'Analyse
            </button>
        </div>
    @endslot
</x-modal>
@endif
<script>

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function printAnalysis() {
 const modal = document.getElementById('feedbackAnalysisModal'); // replace with your modal ID
    if (!modal) {
        console.error('Modal not found');
        return;
    }

    // Save the current page content
    const originalContent = document.body.innerHTML;

    // Replace body with modal content
    document.body.innerHTML = modal.innerHTML;

    // Print only the modal
    window.print();

    // Restore the original page content after printing
    document.body.innerHTML = originalContent;

    // Optionally, reload scripts or reattach event listeners if needed
    location.reload();}

// Close modal when clicking outside
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('fixed')) {
        const modalId = event.target.id;
        closeModal(modalId);
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        const openModals = document.querySelectorAll('.fixed:not(.hidden)');
        openModals.forEach(modal => {
            closeModal(modal.id);
        });
    }
});

// Update button state based on feedback count
document.addEventListener('DOMContentLoaded', function() {
    const analysisButton = document.getElementById('analysisButton');
    const feedbackCount = {{ $activity->feedbacks->count() }};
    
    if (feedbackCount < 3) {
        analysisButton.disabled = true;
    }
});
</script>

<style>
@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}
.animate-float { animation: float 8s ease-in-out infinite; }

@media print {
    #feedbackAnalysisModal,
    #feedbackAnalysisModal * {
        visibility: visible;
    }
    #feedbackAnalysisModal {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        max-width: 100%;
    }
}
</style>
@endsection