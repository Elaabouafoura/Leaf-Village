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
            <h1 class="h3 mb-2 fw-bold text-gradient" style="color: #2e7d32;">Partner Management</h1>
            <p class="text-muted mb-0">Manage and track all your partners in one place</p>
        </div>
        <a href="{{ route('partenaires.create') }}" class="btn btn-lg shadow-sm hover-lift" style="background: linear-gradient(135deg, #4caf50, #66bb6a); color: #fff; border: none; border-radius: 12px;">
            <i class="ti ti-plus me-2"></i> New Partner
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-5">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm hover-shadow" style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9); border-radius: 16px;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title text-muted mb-2">Total Partners</h6>
                            <h3 class="fw-bold mb-0" style="color: #2e7d32;">{{ count($partenaires) }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle" style="background: rgba(76, 175, 80, 0.1);">
                                <i class="ti ti-handshake fs-3" style="color: #4caf50;"></i>
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
                            <h6 class="card-title text-muted mb-2">Companies</h6>
                            <h3 class="fw-bold mb-0" style="color: #1976d2;">{{ $partenaires->where('type', 'entreprise')->count() }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle" style="background: rgba(25, 118, 210, 0.1);">
                                <i class="ti ti-building fs-3" style="color: #1976d2;"></i>
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
                            <h6 class="card-title text-muted mb-2">Institutions</h6>
                            <h3 class="fw-bold mb-0" style="color: #f57c00;">{{ $partenaires->where('type', 'institution')->count() }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle" style="background: rgba(245, 124, 0, 0.1);">
                                <i class="ti ti-school fs-3" style="color: #f57c00;"></i>
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
                            <h6 class="card-title text-muted mb-2">Associations</h6>
                            <h3 class="fw-bold mb-0" style="color: #c2185b;">{{ $partenaires->where('type', 'association')->count() }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle" style="background: rgba(194, 24, 91, 0.1);">
                                <i class="ti ti-users fs-3" style="color: #c2185b;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search & Filters Card -->
    <div class="card border-0 shadow-sm mb-5" style="border-radius: 16px; background: #f8fdf9;">
        <div class="card-body p-4">
            <div class="row g-3 align-items-center">
                <div class="col-md-6">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-transparent border-end-0">
                            <i class="ti ti-search text-muted"></i>
                        </span>
                        <input type="text" id="searchInput" 
                               class="form-control border-start-0 ps-0" placeholder="Search for partners..."
                               style="border-radius: 12px; font-size: 0.95rem;">
                    </div>
                </div>
                <div class="col-md-3">
                    <select id="typeFilter" class="form-select form-select-lg" style="border-radius: 12px; font-size: 0.95rem;">
                        <option value="all">All types</option>
                        <option value="entreprise">Entreprise</option>
                        <option value="institution">Institution</option>
                        <option value="banques">Banques</option>
                        <option value="association">Association</option>
                        <option value="organisme public">Organisme public</option>
                    </select>
                </div>
                <div class="col-md-3 text-md-end">
                    <div class="d-flex gap-2 justify-content-md-end">
                        <button type="button" class="btn btn-outline-secondary px-4" style="border-radius: 12px;" onclick="resetFilters()">
                            <i class="ti ti-refresh me-2"></i> Reset
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Partners Table Card -->
    <div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
        <div class="card-header py-4" style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9); border-bottom: none;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1 fw-bold" style="color: #2e7d32;">
                        <i class="ti ti-handshake me-2"></i>
                        Partner Portfolio
                    </h5>
                    <p class="text-muted mb-0">Showing <span id="visibleCount">{{ count($partenaires) }}</span> partners</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge rounded-pill px-3 py-2" style="background: rgba(76, 175, 80, 0.1); color: #2e7d32;">
                        <i class="ti ti-chart-bar me-1"></i>
                        {{ count($partenaires) }} Total
                    </span>
                </div>
            </div>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background: #f1f8e9;">
                        <tr>
                            <th class="ps-4 py-3 fw-semibold text-uppercase small text-muted">Partner</th>
                            <th class="py-3 fw-semibold text-uppercase small text-muted">Type</th>
                            <th class="py-3 fw-semibold text-uppercase small text-muted">Contact</th>
                            <th class="pe-4 py-3 fw-semibold text-uppercase small text-muted text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="partnersTableBody">
                        @forelse($partenaires as $partenaire)
                        <tr class="border-bottom hover-bg partner-row" 
                            data-name="{{ strtolower($partenaire->nom) }}"
                            data-type="{{ strtolower($partenaire->type) }}">
                            <td class="ps-4 py-4">
                                <div class="d-flex align-items-start">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="p-3 rounded" style="background: rgba(76, 175, 80, 0.1);">
                                            <i class="ti ti-handshake text-primary fs-5"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="fw-bold mb-1" style="color: #2e7d32;">{{ $partenaire->nom }}</h6>
                                        <p class="text-muted mb-0 small">
                                            ID: {{ $partenaire->idPartenaire }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4">
                                @php
                                    $typeClass = match($partenaire->type) {
                                        'entreprise' => 'bg-primary',
                                        'institution' => 'bg-info',
                                        'banques' => 'bg-warning',
                                        'association' => 'bg-purple',
                                        'organisme public' => 'bg-success',
                                        default => 'bg-secondary'
                                    };
                                @endphp
                                <span class="badge {{ $typeClass }} px-3 py-2">{{ $partenaire->type }}</span>
                            </td>
                            <td class="py-4">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="ti ti-user text-muted fs-4"></i>
                                    <span class="fw-semibold">{{ $partenaire->contact }}</span>
                                </div>
                            </td>
                            <td class="pe-4 py-4 text-end">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('partenaires.edit', $partenaire->idPartenaire) }}" class="btn btn-sm btn-light rounded-start-pill px-3"
                                        data-bs-tooltip="tooltip" title="Edit Partner">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-light rounded-0 px-3 text-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deletePartnerModal"
                                        data-partner-name="{{ $partenaire->nom }}"
                                        data-partner-url="{{ route('partenaires.destroy', $partenaire->idPartenaire) }}"
                                        title="Delete Partner">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-4 py-5 text-center">
                                <div class="py-5">
                                    <i class="ti ti-handshake-off display-4 text-muted mb-3 opacity-50"></i>
                                    <h5 class="text-muted mb-3">No partners found</h5>
                                    <p class="text-muted mb-4">Get started by creating your first partner</p>
                                    <a href="{{ route('partenaires.create') }}" class="btn btn-primary btn-lg px-4" style="border-radius: 12px;">
                                        <i class="ti ti-plus me-2"></i> Create Partner
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
    <div class="modal fade" id="deletePartnerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header" style="background: #f8f9fa; border-bottom: none;">
                    <h5 class="modal-title">Delete Partner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete the partner <strong id="deletePartnerName"></strong>?
                </div>
                <div class="modal-footer">
                    <form id="deletePartnerForm" method="POST" action="">
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
    // Delete modal functionality
    var deleteModal = document.getElementById('deletePartnerModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var partnerName = button.getAttribute('data-partner-name');
        var partnerUrl = button.getAttribute('data-partner-url');

        var nameSpan = deleteModal.querySelector('#deletePartnerName');
        nameSpan.textContent = partnerName;

        var form = deleteModal.querySelector('#deletePartnerForm');
        form.action = partnerUrl;
    });

    // Search and filter functionality
    const searchInput = document.getElementById('searchInput');
    const typeFilter = document.getElementById('typeFilter');
    const partnerRows = document.querySelectorAll('.partner-row');
    const visibleCount = document.getElementById('visibleCount');

    function filterPartners() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedType = typeFilter.value.toLowerCase();
        let visibleRows = 0;

        partnerRows.forEach(row => {
            const partnerName = row.getAttribute('data-name');
            const partnerType = row.getAttribute('data-type');
            
            const matchesSearch = partnerName.includes(searchTerm);
            const matchesType = selectedType === 'all' || partnerType.includes(selectedType);
            
            if (matchesSearch && matchesType) {
                row.style.display = '';
                visibleRows++;
            } else {
                row.style.display = 'none';
            }
        });

        visibleCount.textContent = visibleRows;
    }

    function resetFilters() {
        searchInput.value = '';
        typeFilter.value = 'all';
        filterPartners();
    }

    searchInput.addEventListener('input', filterPartners);
    typeFilter.addEventListener('change', filterPartners);

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

.table th {
    font-weight: 600;
    letter-spacing: 0.5px;
    font-size: 0.8rem;
}

.card {
    backdrop-filter: blur(10px);
}

.badge.bg-purple {
    background: linear-gradient(135deg, #9c27b0, #ba68c8) !important;
    color: white;
}

.badge.bg-warning {
    background: linear-gradient(135deg, #ff9800, #ffb74d) !important;
    color: white;
}

.badge.bg-info {
    background: linear-gradient(135deg, #2196f3, #21cbf3) !important;
    color: white;
}

.badge.bg-success {
    background: linear-gradient(135deg, #4caf50, #66bb6a) !important;
    color: white;
}

.badge.bg-primary {
    background: linear-gradient(135deg, #1976d2, #2196f3) !important;
    color: white;
}
</style>
@endsection