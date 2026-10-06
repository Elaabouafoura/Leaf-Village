@extends('layouts.user')

@section('title', 'All Events - Green Spaces')

@section('content')
<div class="bg-cream min-h-screen py-12">
    <div class="container mx-auto px-4 max-w-6xl">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-darken mb-4">All Events</h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Discover all our upcoming and past events dedicated to creating sustainable green spaces.
            </p>
        </div>

        <!-- Filtres -->
        <div class="flex justify-center mb-8">
            <div class="bg-white rounded-lg shadow-sm p-1 flex space-x-1">
                <a href="{{ route('events.front.index') }}" class="px-4 py-2 rounded-md {{ !request()->has('filter') ? 'bg-green-600 text-white' : 'hover:bg-gray-100' }}">
                    All Events
                </a>
                <a href="{{ route('events.front.index', ['filter' => 'upcoming']) }}" class="px-4 py-2 rounded-md {{ request('filter') === 'upcoming' ? 'bg-green-600 text-white' : 'hover:bg-gray-100' }}">
                    Upcoming
                </a>
                <a href="{{ route('events.front.index', ['filter' => 'past']) }}" class="px-4 py-2 rounded-md {{ request('filter') === 'past' ? 'bg-green-600 text-white' : 'hover:bg-gray-100' }}">
                    Past
                </a>
            </div>
        </div>

        <!-- Events Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($events as $event)
            <div class="bg-white shadow-xl rounded-xl overflow-hidden hover:shadow-2xl transition-shadow duration-300">
               <!-- Photo - SOLUTION CORRECTE -->
                @if($event->photo)
                <img src="{{ asset('storage/' . $event->photo) }}" alt="{{ $event->nom }}" class="w-full h-48 object-cover">
                @else
                <div class="w-full h-48 bg-green-100 flex items-center justify-center">
                    <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                @endif
                
                <div class="p-6">
                    <!-- Badge statut -->
                    <div class="mb-3">
                        @if($event->statut === 'Upcoming')
                        <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">
                            🔥 upcoming
                        </span>
                        @else
                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full">
                            ✅ Past
                        </span>
                        @endif
                    </div>
                    
                    <!-- Titre -->
                    <h3 class="font-semibold text-xl mb-3 text-darken">{{ $event->nom }}</h3>
                    
                    <!-- Date -->
                    <div class="mb-3">
                        <span class="bg-green-100 text-green-800 text-sm px-3 py-1 rounded-full">
                            {{ $event->date_formatted }}
                        </span>
                    </div>
                    
                    <!-- Lieu -->
                    @if($event->lieu)
                    <div class="mb-3 text-gray-600 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        </svg>
                        {{ $event->lieu }}
                    </div>
                    @endif
                    
                    <!-- Description -->
                    <p class="text-gray-600 leading-relaxed mb-4">
                        {{ Str::limit($event->description, 120) }}
                    </p>
                    
                    <!-- Projet associé -->
                    @if($event->projet)
                    <div class="mb-3 text-sm text-gray-500">
                        <strong>Project:</strong> {{ $event->projet->nom }}
                    </div>
                    @endif
                    
                    <!-- Bouton -->
                <div x-data="{ open: false }" class="flex space-x-2">
    <!-- Bouton "View Details" -->
    <a href="{{ route('events.front.show', $event->idEvenement) }}"
       class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors text-center flex-1">
        View Details
    </a>

        <!-- Bouton Participate -->
        @auth
            @if(!$event->users->contains(auth()->id()))
                <button onclick="openPopup({{ $event->idEvenement }})"
                        class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors inline-block w-full text-center">
                    Participate
                </button>
            @endif
        @endauth

<!-- Popup -->
<div id="popup-{{ $event->idEvenement }}" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white rounded-lg p-6 w-96 text-center">
        <h2 class="text-lg font-semibold mb-4">Es-tu sûr de vouloir participer à cet événement ?</h2>
        <div class="flex justify-center gap-4">
            <!-- Bouton Confirmer -->
            <form action="{{ route('events.participate', $event->idEvenement) }}" method="POST">
                @csrf
                <button type="submit"
                        class="px-4 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700 transition-colors">
                    Confirmer
                </button>
            </form>
            <!-- Bouton Annuler -->
            <button onclick="closePopup({{ $event->idEvenement }})"
                    class="px-4 py-2 rounded-lg bg-gray-400 text-white hover:bg-gray-500 transition-colors">
                Annuler
            </button>
        </div>
    </div>
</div>

<script>
    function openPopup(id) {
        document.getElementById('popup-' + id).classList.remove('hidden');
    }

    function closePopup(id) {
        document.getElementById('popup-' + id).classList.add('hidden');
    }
</script>

</div>


                </div>
            </div>
            @empty
            <!-- Message si aucun événement -->
            <div class="col-span-3 text-center py-12">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">No Events Available</h3>
                <p class="text-gray-500">Check back later for upcoming events.</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination Bootstrap - CORRIGÉ -->
        @if($events->hasPages())
        <div class="mt-12 flex justify-center">
            <nav>
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if($events->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">‹</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $events->previousPageUrl() }}" rel="prev">‹</a></li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach($events->getUrlRange(1, $events->lastPage()) as $page => $url)
                        @if($page == $events->currentPage())
                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if($events->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $events->nextPageUrl() }}" rel="next">›</a></li>
                    @else
                        <li class="page-item disabled"><span class="page-link">›</span></li>
                    @endif
                </ul>
            </nav>
        </div>
        @endif
    </div>
</div>

<style>
.pagination {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
}
.page-item {
    margin: 0 2px;
}
.page-link {
    display: block;
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    text-decoration: none;
    color: #16A34A;
    background: white;
}
.page-item.active .page-link {
    background-color: #16A34A;
    color: white;
    border-color: #16A34A;
}
.page-item.disabled .page-link {
    color: #6c757d;
    background-color: #f8f9fa;
    border-color: #dee2e6;
}
.page-link:hover {
    background-color: #f0f0f0;
}
</style>
@endsection