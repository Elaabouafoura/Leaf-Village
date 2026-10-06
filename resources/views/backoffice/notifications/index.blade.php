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
            <h1 class="h3 mb-2 fw-bold" style="color: #2e7d32;">📢 Notifications</h1>
            <p class="text-muted mb-0">Notifications management</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-5">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9); border-radius: 16px;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title text-muted mb-2">Total Notifications</h6>
                            <h3 class="fw-bold mb-0" style="color: #2e7d32;">{{ $notifications->count() }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle" style="background: rgba(76, 175, 80, 0.1);">
                                <i class="fas fa-bell fs-3" style="color: #4caf50;"></i>
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
                            <h6 class="card-title text-muted mb-2">Not seen</h6>
                            <h3 class="fw-bold mb-0" style="color: #1976d2;">{{ $notifications->where('etat', false)->count() }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle" style="background: rgba(25, 118, 210, 0.1);">
                                <i class="fas fa-envelope fs-3" style="color: #1976d2;"></i>
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
                            <h6 class="card-title text-muted mb-2">Seen</h6>
                            <h3 class="fw-bold mb-0" style="color: #f57c00;">{{ $notifications->where('etat', true)->count() }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle" style="background: rgba(245, 124, 0, 0.1);">
                                <i class="fas fa-envelope-open fs-3" style="color: #f57c00;"></i>
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
                            <h6 class="card-title text-muted mb-2">With events</h6>
                            <h3 class="fw-bold mb-0" style="color: #c2185b;">{{ $notifications->whereNotNull('evenement_id')->count() }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle" style="background: rgba(194, 24, 91, 0.1);">
                                <i class="fas fa-calendar-alt fs-3" style="color: #c2185b;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifications Table -->
    <div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
        <div class="card-header py-4" style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9); border-bottom: none;">
            <h5 class="fw-bold mb-1" style="color: #2e7d32;">
                <i class="fas fa-bell me-2"></i>List of Notifications
            </h5>
        </div>

        <div class="card-body p-0">
            @if ($notifications->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-bell-slash fa-4x text-muted mb-3 opacity-50"></i>
                    <h5 class="text-muted mb-3"></h5>
                    <p class="text-muted">You are updated ! Aucune nouvelle notification.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead style="background: #f1f8e9;">
                            <tr>
                                <th class="ps-4 py-3 text-muted text-uppercase small fw-semibold">Message</th>
                                <th class="py-3 text-muted text-uppercase small fw-semibold">Event</th>
                                <th class="py-3 text-muted text-uppercase small fw-semibold">Date</th>
                                <th class="py-3 text-muted text-uppercase small fw-semibold">Status</th>
                                <th class="pe-4 py-3 text-muted text-uppercase small fw-semibold text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notifications as $notif)
                                <tr class="@if(!$notif->etat) bg-warning bg-opacity-10 @endif">
                                    <td class="ps-4 py-4">{{ $notif->message }}</td>
                                    <td>{{ $notif->evenement->nom ?? 'Événement supprimé' }}</td>
                                    <td>{{ $notif->evenement->date ?? '-' }}</td>
                                    <td>
                                        @if($notif->etat)
                                            <span class="badge rounded-pill px-3 py-2" style="background: rgba(76, 175, 80, 0.1); color: #2e7d32;">
                                                <i class="fas fa-check-circle me-1"></i>Lue
                                            </span>
                                        @else
                                            <span class="badge rounded-pill px-3 py-2" style="background: rgba(255, 193, 7, 0.1); color: #ffc107;">
                                                <i class="fas fa-bell me-1"></i>Not Seen
                                            </span>
                                        @endif
                                    </td>
                                    <td class="pe-4 py-4 text-center">
                                        <div class="btn-group">
                                            @if(!$notif->etat)
                                                <a href="{{ route('notifications.read', $notif->idNotification) }}" class="btn btn-sm btn-light rounded-start-pill px-3">
                                                    <i class="fas fa-check text-success"></i>
                                                </a>
                                            @endif

                                            <!-- Formulaire de suppression -->
                                            <form action="{{ route('notifications.destroy', $notif->idNotification) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" 
                                                        class="btn btn-sm btn-light rounded-end-pill px-3 text-danger"
                                                        onclick="showDeleteConfirmation(this, '{{ $notif->user->nom ?? 'cette notification' }}')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal de confirmation -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 16px;">
            <div class="modal-header" style="background: linear-gradient(135deg, #fce4ec, #f8bbd9);">
                <h5 class="modal-title fw-bold" style="color: #c2185b;">Confirmation de suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <i class="fas fa-trash-alt fa-3x text-danger mb-3"></i>
                <h4 class="fw-bold mb-3">Delete notification ?</h4>
                <p id="notificationDetails" class="text-muted mb-3">Cette notification sera définitivement supprimée.</p>

                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Annuler
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function showDeleteConfirmation(button, userName) {
    event.preventDefault();

    const participantName = userName && userName.trim() !== '' ? userName : 'cette notification';

    document.getElementById('notificationDetails').textContent =
        `La notification liée à ${participantName} sera définitivement supprimée.`;

    const form = button.closest('form');
    if (form) {
        document.getElementById('deleteForm').action = form.action;
    }

    const modal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
    modal.show();

    return false;
}
</script>

<style>
.card {
    border-radius: 16px;
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
.table th {
    font-weight: 600;
    border-bottom: 1px solid #e9ecef;
}
.alert {
    border-radius: 12px;
}
.bg-warning {
    background-color: rgba(255, 193, 7, 0.1) !important;
}
</style>
@endsection
