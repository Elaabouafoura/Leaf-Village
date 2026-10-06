@extends('layouts.admin')

@section('title', 'Gestion des Activités - Green Spaces')

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

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-5 mt-3">
        <div>
            <h1 class="h3 mb-2 fw-bold text-gradient" style="color: #2e7d32;">
Activity Management</h1>
            <p class="text-muted mb-0">Organize and manage all Green Spaces activities</p>
        </div>
        <button 
            class="btn btn-lg shadow-sm hover-lift"
            style="background: linear-gradient(135deg, #4caf50, #4caf50); color: #fff; border: none; border-radius: 12px;"
            data-bs-toggle="modal" 
            data-bs-target="#addActivityModal">
            <i class="ti ti-plus me-2"></i>
            Add Activity
        </button>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-5">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm hover-shadow" style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9); border-radius: 16px;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title text-muted mb-2">Total Activities</h6>
                            <h3 class="fw-bold mb-0" style="color: #2e7d32;">{{ $activities->count() }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle" style="background: rgba(76, 175, 80, 0.1);">
                                <i class="ti ti-activity fs-3" style="color: #4caf50;"></i>
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
                            <h6 class="card-title text-muted mb-2">With Project</h6>
                            <h3 class="fw-bold mb-0" style="color: #1976d2;">{{ $activities->where('idProjet', '!=', null)->count() }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle" style="background: rgba(25, 118, 210, 0.1);">
                                <i class="ti ti-folders fs-3" style="color: #1976d2;"></i>
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
                            <h6 class="card-title text-muted mb-2">Without Project</h6>
                            <h3 class="fw-bold mb-0" style="color: #f57c00;">{{ $activities->where('idProjet', null)->count() }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle" style="background: rgba(245, 124, 0, 0.1);">
                                <i class="ti ti-folder-off fs-3" style="color: #f57c00;"></i>
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
                            <h6 class="card-title text-muted mb-2">With Members</h6>
                            <h3 class="fw-bold mb-0" style="color: #c2185b;">{{ $activities->filter(function($activity) { return $activity->members->count() > 0; })->count() }}</h3>
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

    <!-- Search & Filter Section -->
    <div class="card border-0 shadow-sm mb-5" style="border-radius: 16px; background: #f8fdf9;">
        <div class="card-body p-4">
            <form method="GET" action="{{ route('activities.index') }}">
                <div class="row g-3 align-items-center">
                    <!-- Search Input -->
                    <div class="col-md-6">
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-transparent border-end-0">
                                <i class="ti ti-search text-muted"></i>
                            </span>
                            <input 
                                type="text" 
                                name="search" 
                                value="{{ request('search') }}"
                                class="form-control border-start-0 ps-0" 
                                placeholder="Rechercher une activité..."
                                style="border-radius: 12px; font-size: 0.95rem;"
                                onchange="this.form.submit()">
                        </div>
                    </div>

                    <!-- Project Filter -->
                    <div class="col-md-4">
                        <select 
                            name="project_id"
                            class="form-select"
                            style="border-radius: 12px; font-size: 0.95rem;"
                            onchange="this.form.submit()">
                            <option value="">All projects</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->idProjet }}" 
                                    {{ request('project_id') == $project->idProjet ? 'selected' : '' }}>
                                    {{ $project->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2 text-md-end">
                        <div class="d-flex gap-2 justify-content-md-end">
                            <button type="submit" class="btn btn-primary px-4" style="border-radius: 12px; background-color: #4caf50; border-color: #4caf50;">
    <i class="ti ti-filter me-2"></i> Apply Filters
</button>
                            <a href="{{ route('activities.index') }}" class="btn btn-outline-secondary px-4" style="border-radius: 12px;">
                                <i class="ti ti-refresh me-2"></i> Reset
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Activities Table Card -->
    <div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
        <div class="card-header py-4" style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9); border-bottom: none;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1 fw-bold" style="color: #2e7d32;">
                        <i class="ti ti-activity me-2"></i>
                        Display of Activities
                    </h5>
                    <p class="text-muted mb-0">List of {{ $activities->count() }} sur {{ $activities->total() }} activités</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge rounded-pill px-3 py-2" style="background: rgba(76, 175, 80, 0.1); color: #2e7d32;">
                        <i class="ti ti-chart-bar me-1"></i>
                        {{ $activities->total() }} Total
                    </span>
                </div>
            </div>
        </div>
        
        <div class="card-body p-0">
            @include('backoffice.activities.table')
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="text-muted small">
            Display of {{ $activities->firstItem() ?? 0 }} à {{ $activities->lastItem() ?? 0 }} sur {{ $activities->total() }} résultats
        </div>
        <div>
            {{ $activities->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    </div>

</div>

<!-- ✅ Add Activity Modal -->
<div class="modal fade" id="addActivityModal" tabindex="-1" aria-labelledby="addActivityModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-header" style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9); border-bottom: none; padding: 1.5rem 1.5rem 1rem;">
                <div class="d-flex align-items-center w-100">
                    <div class="flex-shrink-0 me-3">
                        <div class="p-2 rounded-circle" style="background: rgba(255,255,255,0.3);">
                            <i class="ti ti-plus text-success fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="modal-title fw-bold mb-0 fs-6" style="color: #2e7d32;">Add Activities</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="transform: scale(0.8);"></button>
                </div>
            </div>
            
            <form id="addActivityForm" action="{{ route('activities.store') }}" method="POST">
                @csrf
                <div class="modal-body p-3">
                    <div class="row g-3">
                        <!-- Nom -->
                        <div class="col-12">
                            <label class="form-label fw-semibold small">
                                Name <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="nom" 
                                class="form-control form-control-sm @error('nom') is-invalid @enderror"
                                style="border-radius: 10px; padding: 10px 12px; font-size: 0.9rem;"
                                maxlength="255"
                                required
                                placeholder="Nom de l'activité"
                                value="{{ old('nom') }}"
                            >
                            @error('nom')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="col-12">
                            <label class="form-label fw-semibold small">
                                Description <span class="text-danger">*</span>
                            </label>
                            <textarea 
                                name="description" 
                                rows="3" 
                                class="form-control form-control-sm @error('description') is-invalid @enderror"
                                style="border-radius: 10px; padding: 10px 12px; font-size: 0.9rem;"
                                required
                                placeholder="Description détaillée de l'activité"
                            >{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Projet -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Projet</label>
                            <select 
                                name="idProjet" 
                                class="form-select form-select-sm @error('idProjet') is-invalid @enderror"
                                style="border-radius: 10px; padding: 10px 12px; font-size: 0.9rem;"
                            >
                                <option value="">Select a project</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->idProjet }}" {{ old('idProjet') == $project->idProjet ? 'selected' : '' }}>
                                        {{ $project->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idProjet')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Date -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Date</label>
                            <input 
                                type="date" 
                                name="date" 
                                class="form-control form-control-sm @error('date') is-invalid @enderror"
                                style="border-radius: 10px; padding: 10px 12px; font-size: 0.9rem;"
                                value="{{ old('date') }}"
                            >
                            @error('date')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Membres -->
                        <div class="col-12">
                            <label class="form-label fw-semibold small">Members</label>
                            <select 
                                name="member_ids[]" 
                                class="form-select form-select-sm @error('member_ids') is-invalid @enderror"
                                style="border-radius: 10px; padding: 10px 12px; font-size: 0.9rem;"
                                multiple
                                size="3"
                            >
                                @foreach($members as $member)
                                    <option value="{{ $member->idUser }}" 
                                        @if(collect(old('member_ids'))->contains($member->idUser)) selected @endif>
                                        {{ $member->nom }}
                                    </option>
                                @endforeach
                            </select>
                         
                            @error('member_ids')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer border-top-0 bg-light py-3 px-3">
                    <div class="d-flex gap-2 w-100">
                        <button type="button" class="btn btn-outline-secondary flex-fill btn-sm" data-bs-dismiss="modal" style="border-radius: 10px; padding: 8px 12px;">
                            <i class="ti ti-x me-1"></i>Cancel
                        </button>
                        <button type="submit" class="btn btn-success flex-fill btn-sm" style="border-radius: 10px; padding: 8px 12px; background-color: #4caf50; border-color: #4caf50;">
    <i class="ti ti-check me-1"></i>Create
</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ✅ Update Activity Modals -->
@foreach($activities as $activity)
<div class="modal fade" id="editActivityModal{{ $activity->idActivite }}" tabindex="-1" aria-labelledby="editActivityModalLabel{{ $activity->idActivite }}" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-header" style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9); border-bottom: none; padding: 1.5rem 1.5rem 1rem;">
                <div class="d-flex align-items-center w-100">
                    <div class="flex-shrink-0 me-3">
                        <div class="p-2 rounded-circle" style="background: rgba(255,255,255,0.3);">
                            <i class="ti ti-edit text-warning fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="modal-title fw-bold mb-0 fs-6" style="color: #2e7d32;">Modify Activity</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="transform: scale(0.8);"></button>
                </div>
            </div>
            
            <form id="editActivityForm{{ $activity->idActivite }}" action="{{ route('activities.update', $activity) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-3">
                    <div class="row g-3">
                        <!-- Nom -->
                        <div class="col-12">
                            <label class="form-label fw-semibold small">
                                Name <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="nom" 
                                class="form-control form-control-sm"
                                style="border-radius: 10px; padding: 10px 12px; font-size: 0.9rem;"
                                value="{{ $activity->nom }}" 
                                maxlength="255" 
                                required 
                                placeholder="Nom de l'activité">
                        </div>

                        <!-- Description -->
                        <div class="col-12">
                            <label class="form-label fw-semibold small">
                                Description <span class="text-danger">*</span>
                            </label>
                            <textarea 
                                name="description" 
                                class="form-control form-control-sm"
                                style="border-radius: 10px; padding: 10px 12px; font-size: 0.9rem;"
                                rows="3" 
                                required 
                                placeholder="Description détaillée">{{ $activity->description }}</textarea>
                        </div>

                        <!-- Projet -->
                        <div class="col-12">
                            <label class="form-label fw-semibold small">Project</label>
                            <select 
                                name="projet_id" 
                                class="form-select form-select-sm"
                                style="border-radius: 10px; padding: 10px 12px; font-size: 0.9rem;">
                                <option value="">Select a project</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}" {{ $activity->projet_id == $project->id ? 'selected' : '' }}>
                                        {{ $project->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer border-top-0 bg-light py-3 px-3">
                    <div class="d-flex gap-2 w-100">
                        <button type="button" class="btn btn-outline-secondary flex-fill btn-sm" data-bs-dismiss="modal" style="border-radius: 10px; padding: 8px 12px;">
                            <i class="ti ti-x me-1"></i>Cancel
                        </button>
                        <button type="submit" class="btn btn-warning flex-fill btn-sm" style="border-radius: 10px; padding: 8px 12px; background: linear-gradient(135deg, #4caf50, #4caf50); border: none; color: white;">
                            <i class="ti ti-check me-1"></i>Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- ✅ Delete Confirmation Modal -->
<x-modal id="deleteConfirmModal" title="Confirmer la suppression" type="confirm">
    <div class="text-center py-4">
        <div class="w-16 h-16 mx-auto mb-4 bg-red-100 rounded-2xl flex items-center justify-center">
            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z" />
            </svg>
        </div>
        <p class="text-gray-600 mb-2">Are you sue to delete this activity ?</p>
        <p class="text-sm text-gray-500">this action is not irreversible.</p>
    </div>

    @slot('footer')
        <button type="button" class="flex-1 px-6 py-3 text-gray-700 bg-gray-100 rounded-xl hover:bg-gray-200 transition-colors font-semibold" data-bs-dismiss="modal">
            Cancel
        </button>
        <form id="deleteForm" method="POST" class="flex-1">
            @csrf
            @method('DELETE')
            <button type="submit" class="w-full px-6 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-colors font-semibold">
                Delete
            </button>
        </form>
    @endslot
</x-modal>

<script>
function confirmDelete(url) {
    document.getElementById('deleteForm').setAttribute('action', url);
}

function exportToCSV() {
    // Show loading state
    const button = event.target;
    const originalText = button.innerHTML;
    button.innerHTML = `
        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Export en cours...
    `;
    button.disabled = true;

    // Create hidden iframe for download
    const iframe = document.createElement('iframe');
    iframe.style.display = 'none';
    iframe.src = "{{ route('activities.export') }}";
    
    iframe.onload = function() {
        // Reset button after download starts
        setTimeout(() => {
            button.innerHTML = originalText;
            button.disabled = false;
            
            // Show success message
            showSuccessMessage('Export CSV terminé avec succès!');
        }, 1000);
    };
    
    document.body.appendChild(iframe);
}

function showSuccessMessage(message) {
    // Create toast notification
    const toast = document.createElement('div');
    toast.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-2xl shadow-lg z-50 transform translate-x-full transition-transform duration-300';
    toast.innerHTML = `
        <div class="flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(toast);
    
    // Animate in
    setTimeout(() => {
        toast.classList.remove('translate-x-full');
    }, 100);
    
    // Remove after 3 seconds
    setTimeout(() => {
        toast.classList.add('translate-x-full');
        setTimeout(() => {
            document.body.removeChild(toast);
        }, 300);
    }, 3000);
}


document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const projectFilter = document.getElementById('projectFilter');
    
    // Add event listeners for filtering
    searchInput.addEventListener('input', filterActivities);
    projectFilter.addEventListener('change', filterActivities);
    
    function filterActivities() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedProject = projectFilter.value;
        
        // This is where you would implement your filtering logic
        // For demonstration purposes, we'll just log the values
        console.log('Search term:', searchTerm);
        console.log('Selected project:', selectedProject);
        
        // In a real implementation, you would:
        // 1. Make an AJAX request to your backend with the filter parameters
        // 2. Update the table content with the filtered results
        // 3. Or filter client-side if all data is already loaded
        
        // Example implementation (replace with your actual logic):
        // const rows = document.querySelectorAll('#activitiesTable tbody tr');
        // rows.forEach(row => {
        //     const activityName = row.cells[0].textContent.toLowerCase();
        //     const project = row.getAttribute('data-project');
        //     
        //     const matchesSearch = activityName.includes(searchTerm);
        //     const matchesProject = !selectedProject || project === selectedProject;
        //     
        //     row.style.display = (matchesSearch && matchesProject) ? '' : 'none';
        // });
    }
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
</style>
@endsection