@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">

    <!-- Notifications -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-4" role="alert" style="background: linear-gradient(135deg, #dcedc8, #c5e1a5); border: none; border-radius: 12px; color: #33691e;">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-3 fs-5"></i>
                <div class="flex-grow-1">{{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-5 mt-3">
        <div>
            <h1 class="h3 mb-2 fw-bold" style="color: #2e7d32;">Events Management</h1>
            <Organize class="text-muted mb-0">Organize and manage all Green Spaces events</p>
        </div>
        <a href="{{ route('events.create') }}" class="btn btn-lg shadow-sm" style="background: linear-gradient(135deg, #4caf50, #66bb6a); color: #fff; border: none; border-radius: 12px;">
            <i class="fas fa-plus-circle me-2"></i>Create Event
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-5">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9); border-radius: 16px;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title text-muted mb-2">Total events</h6>
                            <h3 class="fw-bold mb-0" style="color: #2e7d32;">{{ $events->total() }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle" style="background: rgba(76, 175, 80, 0.1);">
                                <i class="fas fa-calendar-alt fs-3" style="color: #4caf50;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #e3f2fd, #bbdefb); border-radius: 16px;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title text-muted mb-2">Upcoming</h6>
                            <h3 class="fw-bold mb-0" style="color: #1976d2;">{{ $events->where('statut', 'Upcoming')->count() }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle" style="background: rgba(25, 118, 210, 0.1);">
                                <i class="fas fa-clock fs-3" style="color: #1976d2;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #fff3e0, #ffcc80); border-radius: 16px;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title text-muted mb-2">Passed</h6>
                            <h3 class="fw-bold mb-0" style="color: #f57c00;">{{ $events->where('statut', 'Past')->count() }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle" style="background: rgba(245, 124, 0, 0.1);">
                                <i class="fas fa-check-circle fs-3" style="color: #f57c00;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #fce4ec, #f8bbd9); border-radius: 16px;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title text-muted mb-2">This mouth</h6>
                            <h3 class="fw-bold mb-0" style="color: #c2185b;">{{ $events->filter(function($event) {
                                return \Carbon\Carbon::parse($event->date)->isCurrentMonth();
                            })->count() }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle" style="background: rgba(194, 24, 91, 0.1);">
                                <i class="fas fa-calendar-week fs-3" style="color: #c2185b;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search & Filter Section -->
    <div class="card border-0 shadow-sm mb-5" style="border-radius: 16px; background: #f8fdf9;">
        <div class="card-body p-4">
            <div class="row g-3 align-items-center">
                <div class="col-md-8">
                    <h5 class="text-success mb-3 mb-md-0">
                        <i class="fas fa-filter me-2"></i>Filter events
                    </h5>
                </div>
                <div class="col-md-4">
                    <form method="GET" action="{{ route('events.index') }}">
                        <select name="filter" class="form-select" onchange="this.form.submit()" style="border-radius: 12px;">
                            <option value="all" {{ request('filter') == 'all' || !request('filter') ? 'selected' : '' }}>All events</option>
                            <option value="upcoming" {{ request('filter') == 'upcoming' ? 'selected' : '' }}> Upcoming Events</option>
                            <option value="past" {{ request('filter') == 'past' ? 'selected' : '' }}>Passed Events </option>
                            <option value="today" {{ request('filter') == 'today' ? 'selected' : '' }}>Today</option>
                            <option value="week" {{ request('filter') == 'week' ? 'selected' : '' }}>This week</option>
                            <option value="month" {{ request('filter') == 'month' ? 'selected' : '' }}>This mouth</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Events Cards Section -->
    <div class="row">
        @foreach($events as $event)
        <div class="col-xl-4 col-lg-6 col-md-12 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; transition: all 0.3s ease;">
                <!-- Event Image -->
                <div class="position-relative overflow-hidden" style="border-radius: 16px 16px 0 0;">
                    @if($event->photo)
                        <img src="{{ asset('storage/' . $event->photo) }}" 
                             class="card-img-top" 
                             alt="{{ $event->nom }}"
                             style="height: 220px; object-fit: cover;">
                    @else
                        <div class="card-img-top d-flex align-items-center justify-content-center"
                             style="height: 220px; background: linear-gradient(135deg, #e8f5e9, #c8e6c9);">
                            <i class="fas fa-leaf fa-4x text-success opacity-50"></i>
                        </div>
                    @endif
                    <div class="position-absolute top-0 end-0 m-3">
                        <span class="badge rounded-pill px-3 py-2 fw-normal" 
                              style="background: {{ $event->statut == 'Upcoming' ? 'rgba(76, 175, 80, 0.9)' : 'rgba(108, 117, 125, 0.9)' }}; color: white;">
                            <i class="fas {{ $event->statut == 'Upcoming' ? 'fa-clock' : 'fa-check-circle' }} me-1"></i>
                            {{ $event->statut }}
                        </span>
                    </div>
                    <div class="position-absolute bottom-0 start-0 w-100 py-2 px-3" 
                         style="background: linear-gradient(transparent 0%, rgba(30, 122, 93, 0.8) 100%);">
                        <small class="text-white">
                            <i class="fas fa-calendar me-1"></i>
                            {{ \Carbon\Carbon::parse($event->date)->translatedFormat('d F Y') }}
                        </small>
                    </div>
                </div>

                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3" style="color: #2e7d32;">
                        {{ $event->nom }}
                    </h5>
                    
                    <div class="event-info mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-map-marker-alt text-success me-2"></i>
                            <span class="text-muted">{{ $event->lieu }}</span>
                        </div>
                        @if($event->projet)
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-project-diagram text-success me-2"></i>
                            <span class="text-muted">{{ $event->projet->nom }}</span>
                        </div>
                        @endif
                    </div>
                    
                    @if($event->description)
                    <div class="event-description">
                        <p class="card-text text-dark opacity-75">
                            {{ Str::limit($event->description, 120) }}
                        </p>
                    </div>
                    @endif
                </div>
                
                <div class="card-footer bg-transparent border-0 pt-0">
                    <div class="btn-group w-100" role="group">
                        <a href="{{ route('events.edit', $event->idEvenement) }}" 
                           class="btn btn-outline-success btn-sm flex-fill" style="border-radius: 10px;">
                            <i class="fas fa-edit me-1"></i>
                        </a>
                        <button type="button" 
                                class="btn btn-outline-danger btn-sm flex-fill" 
                                data-bs-toggle="modal" 
                                data-bs-target="#deleteModal{{ $event->idEvenement }}"
                                style="border-radius: 10px;">
                            <i class="fas fa-trash me-1"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal{{ $event->idEvenement }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0" style="border-radius: 16px;">
                    <div class="modal-header" style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9); border-bottom: none;">
                        <h5 class="modal-title fw-bold" style="color: #2e7d32;">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Confirmer la suppression
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center py-4">
                        <div class="mb-3">
                            <i class="fas fa-trash-alt fa-3x text-success"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-3">Supprimer cet événement ?</h5>
                        <p class="text-muted">
                            L'événement "<strong>{{ $event->nom }}</strong>" sera définitivement supprimé.
                        </p>
                    </div>
                    <div class="modal-footer border-top-0 bg-light">
                        <button type="button" class="btn btn-outline-secondary flex-fill" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Annuler
                        </button>
                        <form action="{{ route('events.destroy', $event->idEvenement) }}" method="POST" class="d-inline flex-fill">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger flex-fill">
                                <i class="fas fa-trash me-2"></i>Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    @if($events->hasPages())
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="text-muted small">
            Affichage de {{ $events->firstItem() ?? 0 }} à {{ $events->lastItem() ?? 0 }} sur {{ $events->total() }} résultats
        </div>
        <div>
            {{ $events->links('pagination::bootstrap-5') }}
        </div>
    </div>
    @endif

    <!-- Empty State -->
    @if($events->isEmpty())
    <div class="card border-0 shadow-sm text-center py-5">
        <div class="card-body">
            <i class="fas fa-calendar-times fa-4x text-muted mb-3 opacity-50"></i>
            <h3 class="text-muted mb-3">Aucun événement trouvé</h3>
            <p class="text-muted mb-4">Soyez le premier à planter une graine de changement !</p>
            <a href="{{ route('events.create') }}" class="btn btn-success btn-lg" style="border-radius: 12px;">
                <i class="fas fa-plus-circle me-2"></i>Créer le premier événement
            </a>
        </div>
    </div>
    @endif
</div>

<style>
.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.btn {
    border-radius: 10px;
}

.badge {
    font-weight: 500;
}

.modal-content {
    border-radius: 16px;
}

.text-success {
    color: #2e7d32 !important;
}

.bg-success {
    background-color: #4caf50 !important;
}
</style>
@endsection