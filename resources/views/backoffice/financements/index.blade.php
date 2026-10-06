@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">

    <!-- Notifications -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-4" role="alert" style="background: linear-gradient(135deg, #dcedc8, #c5e1a5); border: none; border-radius: 12px; color: #33691e;">
            <div class="d-flex align-items-center">
                <i class="ti ti-circle-check me-3 fs-5"></i>
                <div class="flex-grow-1">{{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert" style="background: linear-gradient(135deg, #ffebee, #ffcdd2); border: none; border-radius: 12px; color: #b71c1c;">
            <div class="d-flex align-items-center">
                <i class="ti ti-alert-triangle me-3 fs-5"></i>
                <div class="flex-grow-1">
                    <strong>Please fix the following issues:</strong>
                    <ul class="mb-0 mt-2 ps-3">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-5 mt-3">
        <div>
            <h1 class="h3 mb-2 fw-bold text-gradient" style="color: #2e7d32;">Financing Management</h1>
            <p class="text-muted mb-0">Manage and track all your financing in one place</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('partenaires.index') }}" class="btn btn-lg shadow-sm hover-lift" style="background: linear-gradient(135deg, #31d6f3ff, #21cbf3); color: #fff; border: none; border-radius: 12px;">
                <i class="ti ti-handshake me-2"></i> Partners
            </a>
            <a href="{{ route('financements.create') }}" class="btn btn-lg shadow-sm hover-lift" style="background: linear-gradient(135deg, #4caf50, #66bb6a); color: #fff; border: none; border-radius: 12px;">
                <i class="ti ti-plus me-2"></i> New Financing
            </a>
            <a href="{{ route('financements.analyse.form') }}" class="btn btn-lg shadow-sm hover-lift" style="background: linear-gradient(135deg, #f3dab8ff, #ffb74d); color: #fff; border: none; border-radius: 12px;">
                <i class="ti ti-brain me-2"></i> AI Analysis
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-5">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm hover-shadow" style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9); border-radius: 16px;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title text-muted mb-2">Total Financing</h6>
                            <h3 class="fw-bold mb-0" style="color: #2e7d32;">{{ count($financements) }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle" style="background: rgba(76, 175, 80, 0.1);">
                                <i class="ti ti-cash fs-3" style="color: #4caf50;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm hover-shadow" style="background: linear-gradient(135deg, #e3f2fd, #bbdefb); border-radius: 16px;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title text-muted mb-2">Active</h6>
                            <h3 class="fw-bold mb-0" style="color: #19c0d2ff;">{{ $financements->where('dateFin', '>=', now())->count() }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle" style="background: rgba(25, 118, 210, 0.1);">
                                <i class="ti ti-activity fs-3" style="color: #1976d2;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm hover-shadow" style="background: linear-gradient(135deg, #fff3e0, #ffcc80); border-radius: 16px;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title text-muted mb-2">Upcoming</h6>
                            <h3 class="fw-bold mb-0" style="color: #f57c00;">{{ $financements->where('dateDebut', '>', now())->count() }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle" style="background: rgba(245, 124, 0, 0.1);">
                                <i class="ti ti-clock fs-3" style="color: #f57c00;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm hover-shadow" style="background: linear-gradient(135deg, #fce4ec, #f8bbd9); border-radius: 16px;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title text-muted mb-2">Expired</h6>
                            <h3 class="fw-bold mb-0" style="color: #c2185b;">{{ $financements->where('dateFin', '<', now())->count() }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle" style="background: rgba(194, 24, 91, 0.1);">
                                <i class="ti ti-calendar-off fs-3" style="color: #c2185b;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search & Filters Card -->
    <form action="{{ route('financements.index') }}" method="GET" class="card border-0 shadow-sm mb-5" style="border-radius: 16px; background: #f8fdf9;">
        <div class="card-body p-4">
            <div class="row g-3 align-items-center">
                <div class="col-md-6">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-transparent border-end-0">
                            <i class="ti ti-search text-muted"></i>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               class="form-control border-start-0 ps-0" placeholder="Search financing by project name..."
                               style="border-radius: 12px; font-size: 0.95rem;">
                    </div>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="d-flex gap-2 justify-content-md-end">
                       <button type="submit" class="btn btn-primary px-4" style="border-radius: 12px; background-color: #4caf50; border-color: #4caf50;">
    <i class="ti ti-filter me-2"></i> Apply Filters
</button>
                        <a href="{{ route('financements.index') }}" class="btn btn-outline-secondary px-4" style="border-radius: 12px;">
                            <i class="ti ti-refresh me-2"></i> Reset
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Financing Table Card -->
    <div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
        <div class="card-header py-4" style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9); border-bottom: none;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1 fw-bold" style="color: #2e7d32;">
                        <i class="ti ti-cash me-2"></i>
                        Financing Portfolio
                    </h5>
                    <p class="text-muted mb-0">Showing {{ $financements->count() }} financing records</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge rounded-pill px-3 py-2" style="background: rgba(76, 175, 80, 0.1); color: #2e7d32;">
                        <i class="ti ti-chart-bar me-1"></i>
                        {{ count($financements) }} Total
                    </span>
                </div>
            </div>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background: #f1f8e9;">
                        <tr>
                            <th class="ps-4 py-3 fw-semibold text-uppercase small text-muted">Project</th>
                            <th class="py-3 fw-semibold text-uppercase small text-muted">Partner</th>
                            <th class="py-3 fw-semibold text-uppercase small text-muted">Amount</th>
                            <th class="py-3 fw-semibold text-uppercase small text-muted">Timeline</th>
                            <th class="py-3 fw-semibold text-uppercase small text-muted">Status</th>
                            <th class="pe-4 py-3 fw-semibold text-uppercase small text-muted text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($financements as $financement)
                        <tr class="border-bottom hover-bg">
                            <td class="ps-4 py-4">
                                <div class="d-flex align-items-start">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="p-3 rounded" style="background: rgba(76, 175, 80, 0.1);">
                                            <i class="ti ti-folder text-primary fs-5"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="fw-bold mb-1" style="color: #2e7d32;">{{ $financement->projet->nom ?? 'Financement sans projet' }}</h6>
                                        <p class="text-muted mb-0 small">
                                            ID: {{ $financement->idFinancement }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="p-2 rounded" style="background: rgba(33, 150, 243, 0.1);">
                                        <i class="ti ti-handshake text-primary fs-6"></i>
                                    </div>
                                    <span class="fw-semibold">{{ $financement->partenaire->nom ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="py-4">
                                <span class="fw-bold fs-6" style="color: #2e7d32;">{{ number_format($financement->montant, 0, ',', ' ') }} €</span>
                            </td>
                            <td class="py-4">
                                <div class="d-flex flex-column gap-1">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="ti ti-calendar text-muted fs-4"></i>
                                        <small class="text-muted">{{ \Carbon\Carbon::parse($financement->dateDebut)->format('M d, Y') }}</small>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="ti ti-calendar-off text-muted fs-4"></i>
                                        <small class="text-muted">{{ \Carbon\Carbon::parse($financement->dateFin)->format('M d, Y') }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4">
                                @php
                                    $statusClass = \Carbon\Carbon::parse($financement->dateFin) > now() ? 'bg-success' : 'bg-danger';
                                    $statusText = \Carbon\Carbon::parse($financement->dateFin) > now() ? 'Active' : 'Expired';
                                @endphp
                                <span class="badge {{ $statusClass }} px-3 py-2">{{ $statusText }}</span>
                            </td>
                            <td class="pe-4 py-4 text-end">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('financements.edit', $financement->idFinancement) }}" class="btn btn-sm btn-light rounded-start-pill px-3"
                                        data-bs-tooltip="tooltip" title="Edit Financing">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-light rounded-0 px-3 text-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteFinancingModal"
                                        data-financing-id="{{ $financement->idFinancement }}"
                                        data-financing-project="{{ $financement->projet->nom ?? 'Unknown Project' }}"
                                        data-financing-url="{{ route('financements.destroy', $financement->idFinancement) }}"
                                        title="Delete Financing">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-4 py-5 text-center">
                                <div class="py-5">
                                    <i class="ti ti-cash-off display-4 text-muted mb-3 opacity-50"></i>
                                    <h5 class="text-muted mb-3">No financing found</h5>
                                    <p class="text-muted mb-4">Get started by creating your first financing record</p>
                                    <a href="{{ route('financements.create') }}" class="btn btn-primary btn-lg px-4" style="border-radius: 12px;">
                                        <i class="ti ti-plus me-2"></i> Create Financing
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteFinancingModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header" style="background: #f8f9fa; border-bottom: none;">
                    <h5 class="modal-title">Delete Financing</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete the financing for project <strong id="deleteFinancingProject"></strong>?
                </div>
                <div class="modal-footer">
                    <form id="deleteFinancingForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var deleteModal = document.getElementById('deleteFinancingModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var projectName = button.getAttribute('data-financing-project');
        var financingUrl = button.getAttribute('data-financing-url');

        var projectSpan = deleteModal.querySelector('#deleteFinancingProject');
        projectSpan.textContent = projectName;

        var form = deleteModal.querySelector('#deleteFinancingForm');
        form.action = financingUrl;
    });

    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-tooltip="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>

<style>
.text-gradient {
    background: linear-gradient(135deg, #2e7d32, #4caf50);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hover-shadow {
    transition: all 0.3s ease;
}

.hover-shadow:hover {
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.hover-bg:hover {
    background-color: #f8fdf9 !important;
}

.btn.hover-lift {
    transition: all 0.3s ease;
}

.btn.hover-lift:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(76, 175, 80, 0.3);
}

.progress-bar {
    transition: width 0.6s ease;
}

.table th {
    font-weight: 600;
    letter-spacing: 0.5px;
    font-size: 0.8rem;
}

.card {
    backdrop-filter: blur(10px);
}

.table > :not(caption) > * > * {
    padding: 1rem 0.75rem;
}

.badge {
    font-weight: 600;
    letter-spacing: 0.3px;
}
</style>
@endsection