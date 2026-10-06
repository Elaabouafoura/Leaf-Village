@extends('layouts.user')

@section('title', $event->nom . ' - Green Spaces')

@section('content')
<div class="bg-cream min-h-screen py-12">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="bg-white rounded-xl shadow-xl overflow-hidden">
            <!-- Photo -->
            @if($event->photo)
            <img src="{{ asset('storage/' . $event->photo) }}" alt="{{ $event->nom }}" class="w-full h-64 object-cover">
            @else
            <div class="w-full h-64 bg-green-100 flex items-center justify-center">
                <svg class="w-16 h-16 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            @endif
            
            <div class="p-8">
                <!-- Badge statut -->
                <div class="mb-4">
                    @if($event->statut === 'Upcoming')
                    <span class="bg-green-100 text-green-800 text-sm px-3 py-1 rounded-full">
                        🔥 upcoming event
                    </span>
                    @else
                    <span class="bg-gray-100 text-gray-800 text-sm px-3 py-1 rounded-full">
                        ✅ past event
                    </span>
                    @endif
                </div>
                
                <!-- Titre -->
                <h1 class="text-3xl font-bold text-darken mb-4">{{ $event->nom }}</h1>
                
                <!-- Métadonnées -->
                <div class="grid md:grid-cols-2 gap-4 mb-6">
                    <div class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ $event->date_formatted }}
                    </div>
                    <div class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        </svg>
                        {{ $event->lieu }}
                    </div>
                </div>
                
                <!-- Description -->
                <div class="prose max-w-none mb-6">
                    <p class="text-gray-600 leading-relaxed whitespace-pre-line">{{ $event->description }}</p>
                </div>
                
                <!-- Projet associé -->
                @if($event->projet)
                <div class="border-t pt-6">
                    <h3 class="text-lg font-semibold text-darken mb-2">Associated Project</h3>
                    <p class="text-gray-600">{{ $event->projet->nom }}</p>
                </div>
                @endif
                
                <!-- Boutons d'action -->
                <div class="mt-8 flex justify-between items-center">
                    <a href="{{ route('events.front.index') }}" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors inline-block">
                        < Back to Events
                    </a>
                    
                    <!-- Bouton pour voir les participants -->
                   @auth
                    @if($event->users->count() > 0)
                    <button onclick="openParticipantsModal()" class="flex items-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        View Participants ({{ $event->users->count() }})
                    </button>
                    @endif

                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour les participants -->
@if($event->users->count() > 0)
<div id="participantsModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50 hidden">
    <div class="bg-white rounded-xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
        <!-- En-tête du modal -->
        <div class="bg-green-600 text-white p-6 flex justify-between items-center">
            <h3 class="text-xl font-semibold">Participants ({{ $event->users->count() }})</h3>
            <button onclick="closeParticipantsModal()" class="text-white hover:text-gray-200 text-2xl">
                &times;
            </button>
        </div>
        
        <!-- Contenu du modal -->
        <div class="p-6 max-h-[70vh] overflow-y-auto">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-green-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-gray-700 font-semibold">#</th>
                            <th class="px-4 py-3 text-left text-gray-700 font-semibold">Nom</th>
                            <th class="px-4 py-3 text-left text-gray-700 font-semibold">Email</th>
                            <th class="px-4 py-3 text-left text-gray-700 font-semibold">Date d'inscription</th>
                            <th class="px-4 py-3 text-left text-gray-700 font-semibold">Statut</th>
                            @auth
                                <th class="px-4 py-3 text-left text-gray-700 font-semibold">Action</th>
                            @endauth
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($event->users as $index => $user)
                        <tr class="border-t hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 font-medium">{{ $user->nom ?? $user->name }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $user->email }}</td>
                            <td class="px-4 py-3 text-gray-600">
                                {{ $user->pivot->inscrit_le ? \Carbon\Carbon::parse($user->pivot->inscrit_le)->format('d/m/Y H:i') : '—' }}
                            </td>
                            <td class="px-4 py-3">
                                <span class="capitalize px-2 py-1 rounded-full text-xs 
                                    @if($user->pivot->statut_participation === 'confirmed') bg-green-100 text-green-800
                                    @elseif($user->pivot->statut_participation === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($user->pivot->statut_participation === 'cancelled') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ $user->pivot->statut_participation }}
                                </span>
                            </td>
                            @auth
                                <td class="px-4 py-3">
                                    @if(auth()->id() === $user->idUser)
                                        <button onclick="openCancelModal('{{ $event->idEvenement }}', '{{ $event->nom }}')" 
                                                class="bg-red-600 text-white px-3 py-1 rounded-md hover:bg-red-700 transition">
                                            Annuler
                                        </button>
                                    @endif
                                </td>
                            @endauth
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pied du modal -->
        <div class="border-t p-4 bg-gray-50 flex justify-end">
            <button onclick="closeParticipantsModal()" class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                Close
            </button>
        </div>
    </div>
</div>
@endif

<!-- Modal de confirmation d'annulation -->
<div id="cancelModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-[60] hidden">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full">
        <!-- En-tête du modal (rouge pour danger) -->
        <div class="bg-red-600 text-white p-6 rounded-t-xl flex items-center">
            <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
            </svg>
            <h3 class="text-xl font-semibold">Confirmer l'annulation</h3>
        </div>
        
        <!-- Contenu du modal -->
        <div class="p-6">
            <p class="text-gray-700 mb-2">Êtes-vous sûr de vouloir annuler votre participation à cet événement ?</p>
            <p class="text-gray-600 font-medium" id="eventName"></p>
            <p class="text-red-600 text-sm mt-3">⚠️ Cette action est irréversible.</p>
        </div>
        
        <!-- Boutons d'action -->
        <div class="border-t p-4 bg-gray-50 flex justify-end space-x-3">
            <button onclick="closeCancelModal()" class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                Retour
            </button>
            <form id="cancelForm" method="POST">
                @csrf
                <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Confirmer l'annulation
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function openParticipantsModal() {
    document.getElementById('participantsModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeParticipantsModal() {
    document.getElementById('participantsModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function openCancelModal(eventId, eventName) {
    // Mettre à jour le formulaire avec l'ID de l'événement
    document.getElementById('cancelForm').action = `/events/${eventId}/cancel`;
    
    // Mettre à jour le nom de l'événement dans le modal
    document.getElementById('eventName').textContent = eventName;
    
    // Fermer le modal des participants
    closeParticipantsModal();
    
    // Ouvrir le modal de confirmation d'annulation
    document.getElementById('cancelModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeCancelModal() {
    document.getElementById('cancelModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
    
    // Rouvrir le modal des participants
    setTimeout(() => {
        openParticipantsModal();
    }, 300);
}

// Fermer les modals en cliquant à l'extérieur
document.getElementById('participantsModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeParticipantsModal();
    }
});

document.getElementById('cancelModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeCancelModal();
    }
});

// Fermer les modals avec la touche Échap
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        if (!document.getElementById('cancelModal').classList.contains('hidden')) {
            closeCancelModal();
        } else if (!document.getElementById('participantsModal').classList.contains('hidden')) {
            closeParticipantsModal();
        }
    }
});
</script>

<style>
/* Animation pour les modals */
#participantsModal, #cancelModal {
    transition: opacity 0.3s ease;
}

#participantsModal:not(.hidden), #cancelModal:not(.hidden) {
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}
</style>
@endsection