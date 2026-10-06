@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-5 mt-3">
        <div>
            <div class="d-flex align-items-center mb-2">
                <div class="p-3 rounded-circle me-3" style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9);">
                    <i class="ti ti-folder fs-4" style="color: #4caf50;"></i>
                </div>
                <div>
                    <h1 class="h3 mb-1 fw-bold text-gradient" style="color: #2e7d32;">Project Details</h1>
                    <p class="text-muted mb-0">Complete information about the project</p>
                </div>
            </div>
        </div>
        <div class="btn-group shadow-sm">
            <a href="{{ route('projects.edit', $project) }}" class="btn btn-lg hover-lift" 
               style="background: linear-gradient(135deg, #aed581, #c5e1a5); color: #33691e; border: none; border-radius: 12px 0 0 12px;">
                <i class="ti ti-edit me-2"></i> Edit Project
            </a>
            <a href="{{ route('projects.index') }}" class="btn btn-lg btn-outline-secondary hover-lift" 
               style="border-radius: 0 12px 12px 0;">
                <i class="ti ti-arrow-left me-2"></i> Back to List
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-5" role="alert" 
             style="background: linear-gradient(135deg, #dcedc8, #c5e1a5); border: none; border-radius: 16px; color: #33691e;">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <i class="ti ti-circle-check fs-5 me-3"></i>
                </div>
                <div class="flex-grow-1">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <div class="row g-5">
        <!-- Left Column - Project Details & Green Spaces -->
        <div class="col-lg-8">
            <!-- Project Information Card -->
            <div class="card border-0 shadow-sm hover-shadow mb-5" style="border-radius: 20px; background: #f8fdf9;">
                <div class="card-header py-4 border-bottom-0" 
                     style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9); border-radius: 20px 20px 0 0;">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle me-3" style="background: rgba(255,255,255,0.3);">
                                <i class="ti ti-info-circle text-primary fs-5"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="card-title mb-1 fw-bold" style="color: #2e7d32;">Project Information</h5>
                            <p class="text-muted mb-0 small">Complete project details and specifications</p>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-5">
                    <!-- Project Name & Budget -->
                    <div class="row g-4 mb-5">
                        <div class="col-md-6">
                            <div class="d-flex align-items-start p-4 rounded-3" 
                                 style="background: linear-gradient(135deg, #f1f8e9, #e8f5e9);">
                                <div class="flex-shrink-0">
                                    <div class="p-3 rounded-circle me-3" style="background: rgba(76, 175, 80, 0.1);">
                                        <i class="ti ti-building text-success fs-4"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <label class="form-label fw-semibold text-muted small mb-2">PROJECT NAME</label>
                                    <h4 class="mb-0 fw-bold" style="color: #2e7d32;">{{ $project->nom }}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex align-items-start p-4 rounded-3" 
                                 style="background: linear-gradient(135deg, #f1f8e9, #e8f5e9);">
                                <div class="flex-shrink-0">
                                    <div class="p-3 rounded-circle me-3" style="background: rgba(76, 175, 80, 0.1);">
                                        <i class="ti ti-currency-euro text-success fs-4"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <label class="form-label fw-semibold text-muted small mb-2">BUDGET</label>
                                    <h4 class="mb-0 fw-bold {{ $project->budget ? 'text-success' : 'text-muted' }}">
                                        {{ $project->budget ? number_format($project->budget, 2, '.', ',') . ' €' : 'Not defined' }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Timeline Section -->
                    <div class="mb-5">
                        <h6 class="fw-semibold mb-4" style="color: #2e7d32;">
                            <i class="ti ti-calendar-time me-2"></i>
                            Project Timeline
                        </h6>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center p-3 rounded-2" style="background: #f8fdf9; border: 1px solid #e8f5e9;">
                                    <div class="flex-shrink-0">
                                        <div class="p-2 rounded me-3" style="background: rgba(76, 175, 80, 0.1);">
                                            <i class="ti ti-calendar text-success"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <label class="form-label fw-semibold text-muted small mb-1">START DATE</label>
                                        <div class="fw-semibold" style="color: #2e7d32;">
                                            {{ $project->dateDebut ? \Carbon\Carbon::parse($project->dateDebut)->format('M d, Y') : 'Not defined' }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex align-items-center p-3 rounded-2" style="background: #f8fdf9; border: 1px solid #e8f5e9;">
                                    <div class="flex-shrink-0">
                                        <div class="p-2 rounded me-3" style="background: rgba(76, 175, 80, 0.1);">
                                            <i class="ti ti-calendar-off text-success"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <label class="form-label fw-semibold text-muted small mb-1">END DATE</label>
                                        <div class="fw-semibold" style="color: #2e7d32;">
                                            {{ $project->dateFin ? \Carbon\Carbon::parse($project->dateFin)->format('M d, Y') : 'Not defined' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Description Section -->
                    <div class="mb-4">
                        <h6 class="fw-semibold mb-4" style="color: #2e7d32;">
                            <i class="ti ti-notes me-2"></i>
                            Project Description
                        </h6>
                        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #f1f8e9, #e8f5e9);">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-start">
                                    <div class="flex-shrink-0">
                                        <div class="p-2 rounded me-3" style="background: rgba(76, 175, 80, 0.1);">
                                            <i class="ti ti-edit text-success"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        @if($project->description)
                                            <p class="mb-0 text-dark" style="line-height: 1.7; white-space: pre-line; font-size: 1.05rem;">
                                                {{ $project->description }}
                                            </p>
                                        @else
                                            <p class="mb-0 text-muted fst-italic fs-6">
                                                <i class="ti ti-info-circle me-2"></i>
                                                No description provided
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Associated Green Spaces Card -->
            <div class="card border-0 shadow-sm hover-shadow" style="border-radius: 20px; background: #f8fdf9;">
                <div class="card-header py-4 border-bottom-0" 
                     style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9); border-radius: 20px 20px 0 0;">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle me-3" style="background: rgba(255,255,255,0.3);">
                                <i class="ti ti-plant text-success fs-5"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="card-title mb-1 fw-bold" style="color: #2e7d32;">Associated Green Spaces</h5>
                            <p class="text-muted mb-0 small">Green spaces linked to this project</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-5">
                    @if(isset($project->espacesVerts) && $project->espacesVerts->isNotEmpty())
                        <div class="row g-4">
                            @foreach($project->espacesVerts as $espace)
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start p-4 rounded-3 hover-lift" 
                                         style="background: linear-gradient(135deg, #f1f8e9, #e8f5e9); border: 1px solid #e8f5e9;">
                                        <div class="flex-shrink-0">
                                            <div class="p-3 rounded-circle me-3" style="background: rgba(76, 175, 80, 0.1);">
                                                <i class="ti ti-trees text-success fs-4"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="fw-bold mb-2" style="color: #2e7d32;">{{ $espace->nom }}</h6>
                                            <div class="d-flex align-items-center text-muted small mb-3">
                                                <i class="ti ti-map-pin me-2"></i>
                                                <span>{{ $espace->localisation ?? 'No location specified' }}</span>
                                            </div>
                                            <a href="{{ route('espaces_verts.show', $espace) }}" 
                                               class="btn btn-sm" 
                                               style="background: linear-gradient(135deg, #aed581, #c5e1a5); color: #33691e; border: none;">
                                                <i class="ti ti-external-link me-1"></i>
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="p-4 rounded-3 d-inline-flex mb-3" style="background: linear-gradient(135deg, #f1f8e9, #e8f5e9);">
                                <i class="ti ti-plant-off fs-1" style="color: #9e9e9e;"></i>
                            </div>
                            <h6 class="text-muted mb-2">No Green Spaces Associated</h6>
                            <p class="text-muted small mb-0">This project is not linked to any green spaces yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column - Sidebar -->
        <div class="col-lg-4">
            <!-- Project Overview Card -->
            <div class="card border-0 shadow-sm hover-shadow mb-5" style="border-radius: 20px; background: #f8fdf9;">
                <div class="card-header py-4 border-bottom-0" 
                     style="background: linear-gradient(135deg, #e3f2fd, #bbdefb); border-radius: 20px 20px 0 0;">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle me-3" style="background: rgba(255,255,255,0.3);">
                                <i class="ti ti-chart-bar fs-5" style="color: #1976d2;"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="card-title mb-1 fw-bold" style="color: #1976d2;">Project Overview</h6>
                            <p class="text-muted mb-0 small">Current status and metrics</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <!-- Status Badge -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted small mb-3">PROJECT STATUS</label>
                        <div>
                            @php
                                $now = now();
                                $start = $project->dateDebut ? \Carbon\Carbon::parse($project->dateDebut) : null;
                                $end = $project->dateFin ? \Carbon\Carbon::parse($project->dateFin) : null;
                                
                                if (!$start) {
                                    $status = 'Not started';
                                    $badgeClass = 'background: linear-gradient(135deg, #9e9e9e, #757575); color: #fff;';
                                } elseif ($now->lt($start)) {
                                    $status = 'Scheduled';
                                    $badgeClass = 'background: linear-gradient(135deg, #29b6f6, #0288d1); color: #fff;';
                                } elseif ($end && $now->gt($end)) {
                                    $status = 'Completed';
                                    $badgeClass = 'background: linear-gradient(135deg, #4caf50, #2e7d32); color: #fff;';
                                } else {
                                    $status = 'In progress';
                                    $badgeClass = 'background: linear-gradient(135deg, #ffb74d, #f57c00); color: #fff;';
                                }
                            @endphp
                            <div class="d-flex justify-content-center">
                                <span class="badge fs-6 py-3 px-4 fw-bold" style="{{ $badgeClass }}; border-radius: 12px;">
                                    <i class="ti ti-circle-filled me-2 fs-6"></i>
                                    {{ $status }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Duration -->
                    @if($project->dateDebut && $project->dateFin)
                    <div class="mb-4">
                        <div class="d-flex align-items-center p-3 rounded-2" style="background: rgba(76, 175, 80, 0.05);">
                            <div class="flex-shrink-0">
                                <div class="p-2 rounded me-3" style="background: rgba(76, 175, 80, 0.1);">
                                    <i class="ti ti-clock text-success"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <label class="form-label fw-semibold text-muted small mb-1">TOTAL DURATION</label>
                                <div class="fw-bold fs-5" style="color: #2e7d32;">
                                    {{ \Carbon\Carbon::parse($project->dateDebut)->diffInDays($project->dateFin) }} days
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Timeline -->
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex align-items-center justify-content-between p-3 rounded-2" style="background: rgba(25, 118, 210, 0.05);">
                            <div class="d-flex align-items-center">
                                <div class="p-2 rounded me-3" style="background: rgba(25, 118, 210, 0.1);">
                                    <i class="ti ti-calendar-plus text-primary"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">CREATED</small>
                                    <span class="fw-semibold" style="color: #1976d2;">
                                        {{ $project->created_at->format('M d, Y')?? '--' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between p-3 rounded-2" style="background: rgba(194, 24, 91, 0.05);">
                            <div class="d-flex align-items-center">
                                <div class="p-2 rounded me-3" style="background: rgba(194, 24, 91, 0.1);">
                                    <i class="ti ti-calendar-update text-pink"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">LAST UPDATED</small>
                                    <span class="fw-semibold" style="color: #c2185b;">
                                        {{ $project->updated_at->format('M d, Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="card border-0 shadow-sm hover-shadow" style="border-radius: 20px; background: #f8fdf9;">
                <div class="card-header py-4 border-bottom-0" 
                     style="background: linear-gradient(135deg, #fff3e0, #ffcc80); border-radius: 20px 20px 0 0;">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle me-3" style="background: rgba(255,255,255,0.3);">
                                <i class="ti ti-bolt fs-5" style="color: #f57c00;"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="card-title mb-1 fw-bold" style="color: #f57c00;">Quick Actions</h6>
                            <p class="text-muted mb-0 small">Manage your project</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex flex-column gap-3">
                        <a href="{{ route('projects.edit', $project) }}" class="btn btn-lg hover-lift text-start p-3" 
                           style="background: linear-gradient(135deg, #aed581, #c5e1a5); color: #33691e; border: none; border-radius: 12px;">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="ti ti-edit fs-5 me-3"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-semibold">Edit Project</div>
                                    <small class="opacity-75">Update project details</small>
                                </div>
                                <div class="flex-shrink-0">
                                    <i class="ti ti-chevron-right"></i>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('projects.index') }}" class="btn btn-lg hover-lift text-start p-3" 
                           style="background: linear-gradient(135deg, #e0e0e0, #bdbdbd); color: #424242; border: none; border-radius: 12px;">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="ti ti-list fs-5 me-3"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-semibold">View All Projects</div>
                                    <small class="opacity-75">Browse project portfolio</small>
                                </div>
                                <div class="flex-shrink-0">
                                    <i class="ti ti-chevron-right"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Associated Activities Card -->
<div class="card border-0 shadow-sm hover-shadow mt-5" style="border-radius: 20px; background: #f8fdf9;">
    <div class="card-header py-4 border-bottom-0" 
         style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9); border-radius: 20px 20px 0 0;">
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
                <div class="p-3 rounded-circle me-3" style="background: rgba(255,255,255,0.3);">
                    <i class="ti ti-briefcase text-success fs-5"></i>
                </div>
            </div>
            <div class="flex-grow-1">
                <h5 class="card-title mb-1 fw-bold" style="color: #2e7d32;">Associated Activities</h5>
                <p class="text-muted mb-0 small">Activities linked to this project</p>
            </div>
        </div>
    </div>

    <div class="card-body p-5">
        @if(isset($project->activites) && $project->activites->isNotEmpty())
            <div class="row g-4">
                @foreach($project->activites as $activite)
                    <div class="col-md-6">
                        <div class="d-flex align-items-start p-4 rounded-3 hover-lift" 
                             style="background: linear-gradient(135deg, #f1f8e9, #e8f5e9); border: 1px solid #e8f5e9;">
                            <div class="flex-shrink-0">
                                <div class="p-3 rounded-circle me-3" style="background: rgba(76, 175, 80, 0.1);">
                                    <i class="ti ti-calendar-event text-success fs-4"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-2" style="color: #2e7d32;">{{ $activite->nom }}</h6>
                                <div class="text-muted small mb-2">
                                    <i class="ti ti-calendar me-1"></i>
                                    {{ $activite->date ? \Carbon\Carbon::parse($activite->date)->format('M d, Y') : 'No date defined' }}
                                </div>
                                <p class="text-muted small mb-3" style="min-height: 40px;">
                                    {{ Str::limit($activite->description, 100) }}
                                </p>
                                <a href="{{ route('activities.show', $activite->idActivite) }}" 
                                   class="btn btn-sm" 
                                   style="background: linear-gradient(135deg, #aed581, #c5e1a5); color: #33691e; border: none;">
                                    <i class="ti ti-eye me-1"></i> View Activity
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <div class="p-4 rounded-3 d-inline-flex mb-3" style="background: linear-gradient(135deg, #f1f8e9, #e8f5e9);">
                    <i class="ti ti-calendar-x fs-1" style="color: #9e9e9e;"></i>
                </div>
                <h6 class="text-muted mb-2">No Activities Associated</h6>
                <p class="text-muted small mb-0">This project currently has no linked activities.</p>
            </div>
        @endif
    </div>
</div>

</div>
@endsection

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
        transform: translateY(-2px);
    }
    
    .hover-lift {
        transition: all 0.3s ease;
    }
    
    .hover-lift:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }
    
    .card {
        backdrop-filter: blur(10px);
    }
    
    .badge {
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    
    .form-label {
        letter-spacing: 0.5px;
        font-size: 0.75rem;
        text-transform: uppercase;
    }
</style>
@endpush