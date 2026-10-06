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
            <h1 class="h3 mb-2 fw-bold text-gradient" style="color: #2e7d32;">Project Dashboard</h1>
            <p class="text-muted mb-0">Manage and track all your projects in one place</p>
        </div>
        <a href="{{ route('projects.create') }}" class="btn btn-lg shadow-sm hover-lift" style="background: linear-gradient(135deg, #4caf50, #66bb6a); color: #fff; border: none; border-radius: 12px;">
            <i class="ti ti-plus me-2"></i> New Project
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-5">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm hover-shadow" style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9); border-radius: 16px;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title text-muted mb-2">Total Projects</h6>
                            <h3 class="fw-bold mb-0" style="color: #2e7d32;">{{ $projects->total() }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle" style="background: rgba(76, 175, 80, 0.1);">
                                <i class="ti ti-folders fs-3" style="color: #4caf50;"></i>
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
                            <h3 class="fw-bold mb-0" style="color: #1976d2;">{{ $projects->where('dateDebut', '<=', now())->where('dateFin', '>=', now())->count() }}</h3>
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
                            <h3 class="fw-bold mb-0" style="color: #f57c00;">{{ $projects->where('dateDebut', '>', now())->count() }}</h3>
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
                            <h6 class="card-title text-muted mb-2">Completed</h6>
                            <h3 class="fw-bold mb-0" style="color: #c2185b;">{{ $projects->where('dateFin', '<', now())->count() }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle" style="background: rgba(194, 24, 91, 0.1);">
                                <i class="ti ti-checkbox fs-3" style="color: #c2185b;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <!-- Search & Filters Card -->
<form action="{{ route('projects.index') }}" method="GET" class="card border-0 shadow-sm mb-5" style="border-radius: 16px; background: #f8fdf9;">
    <div class="card-body p-4">
        <div class="row g-3 align-items-center">
            <div class="col-md-6">
                <div class="input-group input-group-lg">
                    <span class="input-group-text bg-transparent border-end-0">
                        <i class="ti ti-search text-muted"></i>
                    </span>
                    <input type="text" name="search_name" value="{{ request('search_name') }}" 
                           class="form-control border-start-0 ps-0" placeholder="Search projects by name..."
                           style="border-radius: 12px; font-size: 0.95rem;">
                </div>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="d-flex gap-2 justify-content-md-end">
                  <button type="submit" class="btn btn-primary px-4" style="border-radius: 12px; background-color: #4caf50; border-color: #4caf50;">
    <i class="ti ti-filter me-2"></i> Apply Filters
</button>
                    <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary px-4" style="border-radius: 12px;">
                        <i class="ti ti-refresh me-2"></i> Reset
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>


    <!-- Projects Table Card -->
    <div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
        <div class="card-header py-4" style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9); border-bottom: none;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1 fw-bold" style="color: #2e7d32;">
                        <i class="ti ti-folders me-2"></i>
                        Project Portfolio
                    </h5>
                    <p class="text-muted mb-0">Showing {{ $projects->count() }} of {{ $projects->total() }} projects</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge rounded-pill px-3 py-2" style="background: rgba(76, 175, 80, 0.1); color: #2e7d32;">
                        <i class="ti ti-chart-bar me-1"></i>
                        {{ $projects->total() }} Total
                    </span>
                </div>
            </div>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background: #f1f8e9;">
                        <tr>
                            <th class="ps-4 py-3 fw-semibold text-uppercase small text-muted" style="border-radius: 0;">Project</th>
                            <th class="py-3 fw-semibold text-uppercase small text-muted">Timeline</th>
                            <th class="py-3 fw-semibold text-uppercase small text-muted">Budget</th>
                            <th class="py-3 fw-semibold text-uppercase small text-muted">Progress</th>
                            <th class="pe-4 py-3 fw-semibold text-uppercase small text-muted text-end" style="border-radius: 0;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($projects as $project)
                        @php
                            if($project->dateDebut && $project->dateFin) {
                                $start = \Carbon\Carbon::parse($project->dateDebut);
                                $end = \Carbon\Carbon::parse($project->dateFin);
                                $now = now();
                                $totalDays = $start->diffInDays($end) ?: 1;
                                if($now->lt($start)) $elapsedDays = 0;
                                elseif($now->gt($end)) $elapsedDays = $totalDays;
                                else $elapsedDays = $start->diffInDays($now);
                                $progress = ($elapsedDays / $totalDays) * 100;
                            } else $progress = null;
                        @endphp

                        <tr class="border-bottom hover-bg">
                            <td class="ps-4 py-4">
                                <div class="d-flex align-items-start">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="p-3 rounded" style="background: rgba(76, 175, 80, 0.1);">
                                            <i class="ti ti-folder text-primary fs-5"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="fw-bold mb-1" style="color: #2e7d32;">{{ $project->nom }}</h6>
                                        <p class="text-muted mb-0 small" style="line-height: 1.4;">
                                            {{ \Illuminate\Support\Str::limit($project->description, 80) }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4">
                                <div class="d-flex flex-column gap-1">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="ti ti-calendar text-muted fs-4"></i>
                                        <small class="text-muted">{{ optional($project->dateDebut) ? \Carbon\Carbon::parse($project->dateDebut)->format('M d, Y') : '-' }}</small>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="ti ti-calendar-off text-muted fs-4"></i>
                                        <small class="text-muted">{{ optional($project->dateFin) ? \Carbon\Carbon::parse($project->dateFin)->format('M d, Y') : '-' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4">
                                @if($project->budget)
                                    <span class="fw-bold fs-6" style="color: #2e7d32;">${{ number_format($project->budget, 2, '.', ',') }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="py-4">
                                @if($progress !== null)
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="flex-grow-1">
                                            <div class="progress" style="height: 8px; border-radius: 10px; background: #e0e0e0;">
                                                <div class="progress-bar" role="progressbar" 
                                                    style="width: {{ $progress }}%; background: linear-gradient(135deg, #4caf50, #66bb6a); border-radius: 10px;" 
                                                    aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                        <small class="fw-bold" style="color: #2e7d32; min-width: 45px;">{{ round($progress) }}%</small>
                                    </div>
                                @else
                                    <span class="badge bg-light text-muted">N/A</span>
                                @endif
                            </td>
                            <td class="pe-4 py-4 text-end">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('projects.show', $project) }}" class="btn btn-sm btn-light rounded-start-pill px-3"
   data-bs-tooltip="tooltip" title="View Project">
   <i class="ti ti-eye"></i>
</a>
                                    <a href="{{ route('projects.edit', $project) }}" class="btn btn-sm btn-light rounded-0 px-3"
                                        data-bs-tooltip="tooltip" title="Edit Project">
                                        <i class="ti ti-edit"></i>
                                    </a>
 <button type="button" class="btn btn-sm btn-light rounded-end-pill px-3 text-danger"
    data-bs-toggle="modal"
    data-bs-target="#deleteProjectModal"
    data-project-name="{{ $project->nom }}"
    data-project-url="{{ route('projects.destroy', $project) }}"
    title="Delete Project">
    <i class="ti ti-trash"></i>
</button>

    <div class="btn-group" role="group">
       
        <a href="{{ route('projects.pdf', $project) }}" target="_blank" class="btn btn-sm btn-light rounded-0 px-3 text-success" title="Generate PDF">
            <i class="ti ti-file-text"></i>
        </a>
    </div>

                                </div>
                            </td>
                        </tr>

                        <!-- Quick View Modal -->
                        <div class="modal fade" id="projectModal{{ $project->id }}" tabindex="-1" aria-labelledby="projectModalLabel{{ $project->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content border-0" style="border-radius: 20px; overflow: hidden;">
                                    <div class="modal-header" style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9); border-bottom: none; padding: 2rem 2rem 1rem;">
                                        <div class="d-flex align-items-center w-100">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="p-3 rounded-circle" style="background: rgba(255,255,255,0.3);">
                                                    <i class="ti ti-folder text-primary fs-4"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h5 class="modal-title fw-bold mb-1" style="color: #2e7d32;">{{ $project->nom }}</h5>
                                                @php
                                                    $now = now();
                                                    $start = $project->dateDebut ? \Carbon\Carbon::parse($project->dateDebut) : null;
                                                    $end = $project->dateFin ? \Carbon\Carbon::parse($project->dateFin) : null;

                                                    if (!$start) {
                                                        $status = 'Not started';
                                                        $badgeClass = 'bg-secondary';
                                                    } elseif ($now->lt($start)) {
                                                        $status = 'Scheduled';
                                                        $badgeClass = 'bg-info';
                                                    } elseif ($end && $now->gt($end)) {
                                                        $status = 'Completed';
                                                        $badgeClass = 'bg-success';
                                                    } else {
                                                        $status = 'In progress';
                                                        $badgeClass = 'bg-primary';
                                                    }
                                                @endphp
                                                <span class="badge {{ $badgeClass }} fs-7">{{ $status }}</span>
                                            </div>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                    </div>
                                    <div class="modal-body p-4">
                                        <!-- Modal content remains the same as original -->
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="fw-semibold text-muted small">START DATE</label>
                                                <p class="mb-2">
                                                    <i class="ti ti-calendar me-2" style="color: #4caf50;"></i>
                                                    {{ $project->dateDebut ? \Carbon\Carbon::parse($project->dateDebut)->format('M d, Y') : 'Not defined' }}
                                                </p>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="fw-semibold text-muted small">END DATE</label>
                                                <p class="mb-2">
                                                    <i class="ti ti-calendar-off me-2" style="color: #4caf50;"></i>
                                                    {{ $project->dateFin ? \Carbon\Carbon::parse($project->dateFin)->format('M d, Y') : 'Not defined' }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="fw-semibold text-muted small">BUDGET</label>
                                            <p class="mb-2">
                                                <i class="ti ti-currency-euro me-2" style="color: #4caf50;"></i>
                                                {{ $project->budget ? number_format($project->budget, 2, '.', ',') . ' €' : 'Not defined' }}
                                            </p>
                                        </div>

                                        <div class="mb-3">
                                            <label class="fw-semibold text-muted small">DESCRIPTION</label>
                                            <div class="bg-light p-3 rounded">
                                                <p class="mb-0" style="line-height: 1.6; white-space: pre-line;">{{ $project->description ?? 'No description provided' }}</p>
                                            </div>
                                        </div>

                                        @if($project->dateDebut && $project->dateFin)
                                        <div class="mb-3">
                                            <label class="fw-semibold text-muted small">DURATION</label>
                                            <p class="mb-2">
                                                <i class="ti ti-clock me-2" style="color: #4caf50;"></i>
                                                {{ \Carbon\Carbon::parse($project->dateDebut)->diffInDays($project->dateFin) }} days
                                            </p>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="modal-footer border-top-0 bg-light">
                                        <div class="d-flex gap-2 w-100">
                                            <a href="{{ route('projects.show', $project) }}" class="btn btn-primary flex-fill">
                                                <i class="ti ti-external-link me-2"></i> Full Details
                                            </a>
                                            <a href="{{ route('projects.edit', $project) }}" class="btn btn-outline-primary flex-fill">
                                                <i class="ti ti-edit me-2"></i> Edit
                                            </a>
                                            <button type="button" class="btn btn-light flex-fill" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

             <!-- Delete confirmation modal: placed once after the table -->
<div class="modal fade" id="deleteProjectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header" style="background: #f8f9fa; border-bottom: none;">
                <h5 class="modal-title">Delete Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete the project <strong id="deleteProjectName"></strong>?
            </div>
            <div class="modal-footer">
                <form id="deleteProjectForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>



                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-5 text-center">
                                <div class="py-5">
                                    <i class="ti ti-folders-off display-4 text-muted mb-3 opacity-50"></i>
                                    <h5 class="text-muted mb-3">No projects found</h5>
                                    <p class="text-muted mb-4">Get started by creating your first project</p>
                                    <a href="{{ route('projects.create') }}" class="btn btn-primary btn-lg px-4" style="border-radius: 12px;">
                                        <i class="ti ti-plus me-2"></i> Create Project
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


    <!-- Pagination -->
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="text-muted small">
            Showing {{ $projects->firstItem() ?? 0 }} to {{ $projects->lastItem() ?? 0 }} of {{ $projects->total() }} results
        </div>
        <div>
            {{ $projects->links('pagination::bootstrap-5') }}
        </div>
    </div>

</div>
@endsection
<script>
document.addEventListener('DOMContentLoaded', function () {
    var deleteModal = document.getElementById('deleteProjectModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // bouton qui a déclenché le modal
        var projectName = button.getAttribute('data-project-name');
        var projectUrl = button.getAttribute('data-project-url');

        // Met à jour le nom du projet dans le modal
        var nameSpan = deleteModal.querySelector('#deleteProjectName');
        nameSpan.textContent = projectName;

        // Met à jour l'action du formulaire
        var form = deleteModal.querySelector('#deleteProjectForm');
        form.action = projectUrl;
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var deleteModalEl = document.getElementById('deleteProjectModal');

    // Use Bootstrap's modal show event
    deleteModalEl.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // le bouton qui a déclenché le modal
        if (!button) return;

        var projectName = button.getAttribute('data-project-name') || '';
        var projectUrl = button.getAttribute('data-project-url') || '';

        // Met à jour le nom du projet dans le modal
        var nameSpan = deleteModalEl.querySelector('#deleteProjectName');
        if (nameSpan) nameSpan.textContent = projectName;

        // Met à jour l'action du formulaire
        var form = deleteModalEl.querySelector('#deleteProjectForm');
        if (form && projectUrl) form.action = projectUrl;
    });
});
</script>

@push('styles')
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
@endpush