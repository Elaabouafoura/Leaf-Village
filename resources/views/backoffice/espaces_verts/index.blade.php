@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">

    <!-- Flash messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-4" role="alert" 
             style="background: linear-gradient(135deg, #dcedc8, #c5e1a5); border: none; border-radius: 12px; color: #33691e;">
            <div class="d-flex align-items-center">
                <i class="ti ti-circle-check me-3 fs-5"></i>
                <div class="flex-grow-1">{{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert" 
             style="background: linear-gradient(135deg, #ffebee, #ffcdd2); border: none; border-radius: 12px; color: #b71c1c;">
            <div class="d-flex align-items-center">
                <i class="ti ti-alert-triangle me-3 fs-5"></i>
                <div class="flex-grow-1">{{ session('error') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <!-- Header -->
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center mb-6 mt-4 gap-4">
        <div class="flex-grow-1">
            <div class="d-flex align-items-center mb-3">
                <div class="p-3 rounded-3 me-4" style="background: linear-gradient(135deg, #4caf50, #66bb6a);">
                    <i class="ti ti-trees fs-4 text-white"></i>
                </div>
                <div>
                    <h1 class="h2 mb-2 fw-bold" style="color: #2e7d32;">Green Spaces Management</h1>
                    <p class="text-gray-600 mb-0">Manage all green spaces associated with your ecological projects</p>
                </div>
            </div>
        </div>
        <button class="btn btn-lg shadow-sm hover-lift" data-bs-toggle="modal" data-bs-target="#createEspaceVertModal"
                style="background: linear-gradient(135deg, #4caf50, #66bb6a); color: #fff; border: none; border-radius: 12px;">
            <i class="ti ti-plus me-2"></i> New Green Space
        </button>
    </div>

    <!-- Search Card -->
    <div class="card border-0 shadow-sm mb-5" style="border-radius: 16px; background: #f8fdf9;">
        <div class="card-body p-4">
            <form method="GET" action="{{ route('espaces_verts.index') }}">
                <div class="row g-3 align-items-center">
                    <div class="col-md-6">
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-transparent border-end-0">
                                <i class="ti ti-search text-muted"></i>
                            </span>
                            <input type="text" name="search_location" value="{{ request('search_location') }}" 
                                   class="form-control border-start-0 ps-0" placeholder="Search by location..."
                                   style="border-radius: 12px; font-size: 0.95rem;">
                        </div>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <div class="d-flex gap-2 justify-content-md-end">
                           <button type="submit" class="btn btn-primary px-4" style="border-radius: 12px; background-color: #4caf50; border-color: #4caf50;">
    <i class="ti ti-search me-2"></i> Search
</button>
                            <a href="{{ route('espaces_verts.index') }}" class="btn btn-outline-secondary px-4" style="border-radius: 12px;">
                                <i class="ti ti-refresh me-2"></i> Reset
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-5">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm hover-shadow" style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9); border-radius: 16px;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title text-muted mb-2">Total Green Spaces</h6>
                            <h3 class="fw-bold mb-0" style="color: #2e7d32;">{{ $espaces->total() }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle" style="background: rgba(76, 175, 80, 0.1);">
                                <i class="ti ti-leaf fs-3" style="color: #4caf50;"></i>
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
                            <h3 class="fw-bold mb-0" style="color: #1976d2;">{{ $espaces->where('idProjet', '!=', null)->count() }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle" style="background: rgba(25, 118, 210, 0.1);">
                                <i class="ti ti-link fs-3" style="color: #1976d2;"></i>
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
                            <h3 class="fw-bold mb-0" style="color: #f57c00;">{{ $espaces->where('idProjet', null)->count() }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle" style="background: rgba(245, 124, 0, 0.1);">
                                <i class="ti ti-unlink fs-3" style="color: #f57c00;"></i>
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
                            <h6 class="card-title text-muted mb-2">Total Surface Area</h6>
                            <h3 class="fw-bold mb-0" style="color: #c2185b;">{{ number_format($espaces->sum('surface'), 0) }} m²</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle" style="background: rgba(194, 24, 91, 0.1);">
                                <i class="ti ti-ruler-2 fs-3" style="color: #c2185b;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
        <div class="card-header py-4" style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9); border-bottom: none;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1 fw-bold" style="color: #2e7d32;">
                        <i class="ti ti-trees me-2"></i>
                        Green Spaces Inventory
                    </h5>
                    <p class="text-muted mb-0">Displaying {{ $espaces->count() }} of {{ $espaces->total() }} green spaces</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge rounded-pill px-3 py-2" style="background: rgba(76, 175, 80, 0.1); color: #2e7d32;">
                        <i class="ti ti-leaf me-1"></i>
                        {{ $espaces->total() }} Total
                    </span>
                </div>
            </div>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background: #f1f8e9;">
                        <tr>
                            <th class="ps-4 py-3 fw-semibold text-uppercase small text-muted">Green Space</th>
                            <th class="py-3 fw-semibold text-uppercase small text-muted">Surface Area</th>
                            <th class="py-3 fw-semibold text-uppercase small text-muted">Location</th>
                            <th class="py-3 fw-semibold text-uppercase small text-muted">Type</th>
                            <th class="py-3 fw-semibold text-uppercase small text-muted">Associated Project</th>
                            <th class="py-3 fw-semibold text-uppercase small text-muted">Eco-Score</th>
                            <th class="py-3 fw-semibold text-uppercase small text-muted">Justification</th>
                            <th class="pe-4 py-3 fw-semibold text-uppercase small text-muted text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($espaces as $espace)
                        <tr class="border-bottom hover-bg">
                            <td class="ps-4 py-4">
                                <div class="d-flex align-items-start">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="p-3 rounded" style="background: rgba(76, 175, 80, 0.1);">
                                            <i class="ti ti-trees text-success fs-5"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="fw-bold mb-1" style="color: #2e7d32;">{{ $espace->nom }}</h6>
                                        <div class="d-flex align-items-center gap-2 mt-1">
                                            @if($espace->idProjet)
                                                <span class="badge bg-success bg-opacity-10 text-success fs-7">Associated</span>
                                            @else
                                                <span class="badge bg-secondary bg-opacity-10 text-secondary fs-7">Not Associated</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4">
                                @if($espace->surface)
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="ti ti-ruler-2 text-muted fs-4"></i>
                                        <span class="fw-semibold" style="color: #2e7d32;">
                                            {{ number_format($espace->surface, 2) }} m²
                                        </span>
                                    </div>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td class="py-4">
                                @if($espace->localisation)
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="ti ti-map-pin text-muted fs-4"></i>
                                        <span class="text-muted">{{ $espace->localisation }}</span>
                                    </div>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td class="py-4">
                                @if($espace->type)
                                    <span class="badge bg-primary bg-opacity-10 text-primary">{{ $espace->type }}</span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td class="py-4">
                                @if($espace->projet)
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="ti ti-folder text-muted fs-4"></i>
                                        <span class="fw-semibold" style="color: #2e7d32;">{{ $espace->projet->nom }}</span>
                                    </div>
                                @else
                                    <span class="text-muted">None</span>
                                @endif
                            </td>

<td class="py-4">
    @if($espace->eco_score)
        🌱 <strong>{{ $espace->eco_score }}%</strong>
    @else
        —
    @endif
</td>
<td class="py-4">
    {{ $espace->eco_justification ?? 'Not generated' }}
</td>




                            <td class="pe-4 py-4 text-end">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-sm btn-light rounded-start-pill px-3"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editEspaceVertModal{{ $espace->idEspace }}"
                                            data-bs-tooltip="tooltip" title="Edit">
                                        <i class="ti ti-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-light rounded-end-pill px-3 text-danger"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteEspaceVertModal{{ $espace->idEspace }}" 
                                            data-bs-tooltip="tooltip" title="Delete">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-4 py-5 text-center">
                                <div class="py-5">
                                    <i class="ti ti-trees-off display-4 text-muted mb-3 opacity-50"></i>
                                    <h5 class="text-muted mb-3">No green spaces found</h5>
                                    <p class="text-muted mb-4">Start by creating your first green space</p>
                                    <button class="btn btn-primary btn-lg px-4" data-bs-toggle="modal" data-bs-target="#createEspaceVertModal"
                                            style="border-radius: 12px;">
                                        <i class="ti ti-plus me-2"></i> Create Green Space
                                    </button>
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
            Displaying {{ $espaces->firstItem() ?? 0 }} to {{ $espaces->lastItem() ?? 0 }} of {{ $espaces->total() }} results
        </div>
        <div>
            {{ $espaces->links('pagination::bootstrap-5') }}
        </div>
    </div>

</div>
<!-- Create Modal -->
<div class="modal fade" id="createEspaceVertModal" tabindex="-1" aria-labelledby="createEspaceVertModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 20px; overflow: hidden;">
            
            <!-- Modal Header -->
            <div class="modal-header" style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9); border-bottom: none; padding: 2rem 2rem 1rem;">
                <div class="d-flex align-items-center w-100">
                    <div class="flex-shrink-0 me-3">
                        <div class="p-3 rounded-circle" style="background: rgba(255,255,255,0.3);">
                            <i class="ti ti-plus text-success fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="modal-title fw-bold mb-1" style="color: #2e7d32;">Add Green Space</h5>
                        <p class="text-muted mb-0 small">Create a new green space in your inventory</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>

            <!-- Modal Form -->
            <form action="{{ route('espaces_verts.store') }}" method="POST">
                @csrf

                <div class="modal-body p-4">
                    <div class="row g-4">

                        <!-- NAME -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted small mb-2">
                                NAME <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="nom" 
                                   value="{{ old('nom') }}" 
                                   class="form-control p-3 @error('nom') is-invalid @enderror" 
                                   placeholder="Ex: Central Park" required
                                   style="border-radius: 12px; border: 1px solid #e8f5e9;">
                            @error('nom')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- SURFACE -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted small mb-2">SURFACE AREA (m²)</label>
                            <input type="number" step="0.01" name="surface" 
                                   value="{{ old('surface') }}" 
                                   class="form-control p-3 @error('surface') is-invalid @enderror" 
                                   placeholder="Ex: 1500.50"
                                   style="border-radius: 12px; border: 1px solid #e8f5e9;">
                            @error('surface')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- LOCATION -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted small mb-2">LOCATION</label>
                            <input type="text" name="localisation" 
                                   value="{{ old('localisation') }}" 
                                   class="form-control p-3 @error('localisation') is-invalid @enderror" 
                                   placeholder="Ex: North District"
                                   style="border-radius: 12px; border: 1px solid #e8f5e9;">
                            @error('localisation')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- TYPE -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted small mb-2">TYPE</label>
                            <input type="text" name="type" 
                                   value="{{ old('type') }}" 
                                   class="form-control p-3 @error('type') is-invalid @enderror" 
                                   placeholder="Ex: Public Garden"
                                   style="border-radius: 12px; border: 1px solid #e8f5e9;">
                            @error('type')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- ASSOCIATED PROJECT -->
                        <div class="col-12">
                            <label class="form-label fw-semibold text-muted small mb-2">ASSOCIATED PROJECT</label>
                            <select name="idProjet" 
                                    class="form-select p-3 @error('idProjet') is-invalid @enderror" 
                                    style="border-radius: 12px; border: 1px solid #e8f5e9;">
                                <option value="">— No project —</option>
                                @foreach($projects as $proj)
                                    <option value="{{ $proj->idProjet }}" {{ (string) old('idProjet') === (string) $proj->idProjet ? 'selected' : '' }}>
                                        {{ $proj->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idProjet')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer border-top-0 bg-light">
                    <div class="d-flex gap-2 w-100">
                        <button type="button" class="btn btn-outline-secondary flex-fill" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success flex-fill" 
                                style="background: linear-gradient(135deg, #4caf50, #66bb6a); border: none;">
                            <i class="ti ti-plus me-2"></i> Create Green Space
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- Script pour rouvrir le modal si erreurs -->
@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var modal = new bootstrap.Modal(document.getElementById('createEspaceVertModal'));
            modal.show();
        });
    </script>
@endif

<!-- Edit & Delete Modals -->
@foreach ($espaces as $espace)
    <!-- Edit Modal -->
    <div class="modal fade" id="editEspaceVertModal{{ $espace->idEspace }}" tabindex="-1" aria-labelledby="editEspaceVertModalLabel{{ $espace->idEspace }}" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0" style="border-radius: 20px; overflow: hidden;">
                
                <!-- HEADER -->
                <div class="modal-header" style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9); border-bottom: none; padding: 2rem 2rem 1rem;">
                    <div class="d-flex align-items-center w-100">
                        <div class="flex-shrink-0 me-3">
                            <div class="p-3 rounded-circle" style="background: rgba(255,255,255,0.3);">
                                <i class="ti ti-edit text-success fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="modal-title fw-bold mb-1" style="color: #2e7d32;">Edit: {{ $espace->nom }}</h5>
                            <p class="text-muted mb-0 small">Update the information for this green space</p>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>

                <!-- FORMULAIRE -->
                <form action="{{ route('espaces_verts.update', $espace) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body p-4">

                        @if ($errors->any() && session('edit_modal_id') == $espace->idEspace)
                            <div class="alert alert-danger mb-3">
                                Please correct the errors below.
                            </div>
                        @endif

                        <div class="row g-4">
                            <!-- NOM -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-muted small mb-2">
                                    NAME <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       name="nom"
                                       value="{{ old('nom', $espace->nom) }}"
                                       class="form-control p-3 @error('nom') is-invalid @enderror"
                                       required
                                       style="border-radius: 12px; border: 1px solid #e8f5e9;">
                                @if ($errors->has('nom') && session('edit_modal_id') == $espace->idEspace)
                                    <div class="invalid-feedback d-block mt-1">
                                        {{ $errors->first('nom') }}
                                    </div>
                                @endif
                            </div>

                            <!-- SURFACE -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-muted small mb-2">SURFACE AREA (m²)</label>
                                <input type="number" step="0.01"
                                       name="surface"
                                       value="{{ old('surface', $espace->surface) }}"
                                       class="form-control p-3 @error('surface') is-invalid @enderror"
                                       style="border-radius: 12px; border: 1px solid #e8f5e9;">
                                @if ($errors->has('surface') && session('edit_modal_id') == $espace->idEspace)
                                    <div class="invalid-feedback d-block mt-1">
                                        {{ $errors->first('surface') }}
                                    </div>
                                @endif
                            </div>

                            <!-- LOCALISATION -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-muted small mb-2">LOCATION</label>
                                <input type="text" 
                                       name="localisation"
                                       value="{{ old('localisation', $espace->localisation) }}"
                                       class="form-control p-3 @error('localisation') is-invalid @enderror"
                                       style="border-radius: 12px; border: 1px solid #e8f5e9;">
                                @if ($errors->has('localisation') && session('edit_modal_id') == $espace->idEspace)
                                    <div class="invalid-feedback d-block mt-1">
                                        {{ $errors->first('localisation') }}
                                    </div>
                                @endif
                            </div>

                            <!-- TYPE -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-muted small mb-2">TYPE</label>
                                <input type="text" 
                                       name="type"
                                       value="{{ old('type', $espace->type) }}"
                                       class="form-control p-3 @error('type') is-invalid @enderror"
                                       style="border-radius: 12px; border: 1px solid #e8f5e9;">
                                @if ($errors->has('type') && session('edit_modal_id') == $espace->idEspace)
                                    <div class="invalid-feedback d-block mt-1">
                                        {{ $errors->first('type') }}
                                    </div>
                                @endif
                            </div>

                            <!-- PROJET -->
                            <div class="col-12">
                                <label class="form-label fw-semibold text-muted small mb-2">ASSOCIATED PROJECT</label>
                                <select name="idProjet"
                                        class="form-select p-3 @error('idProjet') is-invalid @enderror"
                                        style="border-radius: 12px; border: 1px solid #e8f5e9;">
                                    <option value="">— No project —</option>
                                    @foreach($projects as $proj)
                                        <option value="{{ $proj->idProjet }}" 
                                            {{ (string) old('idProjet', $espace->idProjet) === (string) $proj->idProjet ? 'selected' : '' }}>
                                            {{ $proj->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('idProjet') && session('edit_modal_id') == $espace->idEspace)
                                    <div class="invalid-feedback d-block mt-1">
                                        {{ $errors->first('idProjet') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- FOOTER -->
                    <div class="modal-footer border-top-0 bg-light">
                        <div class="d-flex gap-2 w-100">
                            <button type="button" class="btn btn-outline-secondary flex-fill" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success flex-fill" 
                                    style="background: linear-gradient(135deg, #4caf50, #66bb6a); border: none;">
                                <i class="ti ti-check me-2"></i> Save Changes
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


<!-- SCRIPT: Réouvrir le bon modal si erreur -->
@if (session('edit_modal_id'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var modalId = 'editEspaceVertModal{{ session('edit_modal_id') }}';
        var modalElement = document.getElementById(modalId);
        if (modalElement) {
            var modal = new bootstrap.Modal(modalElement);
            modal.show();
        }
    });
</script>
@endif

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteEspaceVertModal{{ $espace->idEspace }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0" style="border-radius: 20px;">
                <div class="modal-header" style="background: linear-gradient(135deg, #ffebee, #ffcdd2); border-bottom: none;">
                    <div class="d-flex align-items-center w-100">
                        <div class="flex-shrink-0 me-3">
                            <div class="p-3 rounded-circle" style="background: rgba(255,255,255,0.3);">
                                <i class="ti ti-trash text-danger fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="modal-title fw-bold mb-1" style="color: #d32f2f;">Delete Green Space</h5>
                            <p class="text-muted mb-0 small">Irreversible action</p>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                </div>
                <form action="{{ route('espaces_verts.destroy', $espace) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body p-4 text-center">
                        <div class="p-3 rounded-3 bg-danger bg-opacity-10 d-inline-flex mb-3">
                            <i class="ti ti-alert-triangle fs-1 text-danger"></i>
                        </div>
                        <h6 class="fw-bold text-gray-900 mb-2">Confirm Deletion</h6>
                        <p class="text-muted mb-3">Are you sure you want to permanently delete this green space?</p>
                        <div class="bg-light p-3 rounded-2">
                            <span class="fw-bold text-danger">{{ $espace->nom }}</span>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 bg-light">
                        <div class="d-flex gap-2 w-100">
                            <button type="button" class="btn btn-outline-secondary flex-fill" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger flex-fill">
                                <i class="ti ti-trash me-2"></i> Delete
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

@endsection

@push('styles')
<style>
    .hover-shadow {
        transition: all 0.3s ease;
    }
    
    .hover-shadow:hover {
        box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
        transform: translateY(-2px);
    }
    
    .hover-bg:hover {
        background-color: #f8fdf9 !important;
    }
    
    .hover-lift {
        transition: all 0.3s ease;
    }
    
    .hover-lift:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(76, 175, 80, 0.3);
    }
    
    .text-gradient {
        background: linear-gradient(135deg, #2e7d32, #4caf50);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .card {
        backdrop-filter: blur(10px);
    }
    
    .table th {
        font-weight: 600;
        letter-spacing: 0.5px;
        font-size: 0.8rem;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-tooltip="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Add hover effects
        const cards = document.querySelectorAll('.hover-shadow');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-4px)';
            });
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    });
</script>
@endpush