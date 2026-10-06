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

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-5 mt-3">
        <div>
            <h1 class="h3 mb-2 fw-bold text-gradient" style="color: #2e7d32;">Resource Management</h1>
            <p class="text-muted mb-0">Efficiently manage your green space resources</p>
        </div>
        <button class="btn btn-lg shadow-sm hover-lift" 
                style="background: linear-gradient(135deg, #4caf50, #66bb6a); color: #fff; border: none; border-radius: 12px;"
                data-bs-toggle="modal" data-bs-target="#createRessource">
            <i class="ti ti-plus me-2"></i> New Resource
        </button>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-5">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm hover-shadow" style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9); border-radius: 16px;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title text-muted mb-2">Total Resources</h6>
                            <h3 class="fw-bold mb-0" style="color: #2e7d32;">{{ $ressources->total() }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle" style="background: rgba(76, 175, 80, 0.1);">
                                <i class="ti ti-package fs-3" style="color: #4caf50;"></i>
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
                            <h6 class="card-title text-muted mb-2">Low Stock</h6>
                            <h3 class="fw-bold mb-0" style="color: #1976d2;">{{ $ressources->where('quantite', '<', 10)->count() }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle" style="background: rgba(25, 118, 210, 0.1);">
                                <i class="ti ti-alert-triangle fs-3" style="color: #1976d2;"></i>
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
                            <h6 class="card-title text-muted mb-2">Plant</h6>
                            <h3 class="fw-bold mb-0" style="color: #f57c00;">{{ $ressources->where('type', 'Végétal')->count() }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle" style="background: rgba(245, 124, 0, 0.1);">
                                <i class="ti ti-leaf fs-3" style="color: #f57c00;"></i>
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
                            <h6 class="card-title text-muted mb-2">Equipment</h6>
                            <h3 class="fw-bold mb-0" style="color: #c2185b;">{{ $ressources->where('type', 'Équipement')->count() }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle" style="background: rgba(194, 24, 91, 0.1);">
                                <i class="ti ti-tool fs-3" style="color: #c2185b;"></i>
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
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Search</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0">
                            <i class="ti ti-search text-muted"></i>
                        </span>
                        <input type="text" id="searchInput" class="form-control border-start-0 ps-0" placeholder="Name, type...">
                    </div>
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-semibold">Type</label>
                    <select id="typeFilter" class="form-select">
                        <option value="">All types</option>
                        <option value="Matériel">Material</option>
                        <option value="Végétal">Plant</option>
                        <option value="Engrais">Fertilizer</option>
                        <option value="Outillage">Tools</option>
                        <option value="Équipement">Equipment</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-semibold">Quantity</label>
                    <select id="quantityFilter" class="form-select">
                        <option value="">All</option>
                        <option value="low">Low (&lt; 10)</option>
                        <option value="medium">Medium (10-50)</option>
                        <option value="high">High (&gt; 50)</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Activity</label>
                    <select id="activityFilter" class="form-select">
                        <option value="">All activities</option>
                        @foreach($activites as $activite)
                            <option value="{{ $activite->idActivite }}">{{ $activite->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button id="resetFilters" class="btn btn-outline-secondary w-100">
                        <i class="ti ti-refresh me-1"></i>Reset
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Resources Table Card -->
    <div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
        <div class="card-header py-4" style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9); border-bottom: none;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1 fw-bold" style="color: #2e7d32;">
                        <i class="ti ti-packages me-2"></i>
                        Resource Inventory
                    </h5>
                    <p class="text-muted mb-0">Displaying {{ $ressources->count() }} out of {{ $ressources->total() }} resources</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge rounded-pill px-3 py-2" style="background: rgba(76, 175, 80, 0.1); color: #2e7d32;">
                        <i class="ti ti-chart-bar me-1"></i>
                        {{ $ressources->total() }} Total
                    </span>
                </div>
            </div>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="ressourcesTable">
                    <thead style="background: #f1f8e9;">
                        <tr>
                            <th class="ps-4 py-3 fw-semibold text-uppercase small text-muted" style="border-radius: 0;">Resource</th>
                            <th class="py-3 fw-semibold text-uppercase small text-muted">Type</th>
                            <th class="py-3 fw-semibold text-uppercase small text-muted">Quantity</th>
                            <th class="py-3 fw-semibold text-uppercase small text-muted">Activity</th>
                            <th class="py-3 fw-semibold text-uppercase small text-muted">Supplier</th>
                            <th class="pe-4 py-3 fw-semibold text-uppercase small text-muted text-end" style="border-radius: 0;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ressources as $ressource)
                            <tr class="border-bottom hover-bg" 
                                data-type="{{ $ressource->type }}" 
                                data-quantite="{{ $ressource->quantite }}" 
                                data-activite="{{ $ressource->idActivite }}">
                                <td class="ps-4 py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="p-3 rounded" 
                                                style="background: 
                                                    @if($ressource->type == 'Végétal') rgba(76, 175, 80, 0.1)
                                                    @elseif($ressource->type == 'Outillage') rgba(33, 150, 243, 0.1)
                                                    @elseif($ressource->type == 'Engrais') rgba(255, 152, 0, 0.1)
                                                    @elseif($ressource->type == 'Équipement') rgba(156, 39, 176, 0.1)
                                                    @else rgba(158, 158, 158, 0.1) @endif">
                                                @if($ressource->type == 'Végétal')
                                                    <i class="ti ti-leaf text-success fs-5"></i>
                                                @elseif($ressource->type == 'Outillage')
                                                    <i class="ti ti-tool text-primary fs-5"></i>
                                                @elseif($ressource->type == 'Engrais')
                                                    <i class="ti ti-flask text-warning fs-5"></i>
                                                @elseif($ressource->type == 'Équipement')
                                                    <i class="ti ti-tractor text-info fs-5"></i>
                                                @else
                                                    <i class="ti ti-package text-secondary fs-5"></i>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="fw-bold mb-1" style="color: #2e7d32;">{{ $ressource->nom }}</h6>
                                            @if($ressource->quantite < 10)
                                                <div class="d-flex align-items-center">
                                                    <i class="ti ti-alert-triangle text-danger me-1 fs-6"></i>
                                                    <small class="text-danger">Low stock</small>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4">
                                    <span class="badge rounded-pill px-3 py-2 fw-normal" 
                                        style="background: 
                                            @if($ressource->type == 'Végétal') rgba(76, 175, 80, 0.1); color: #2e7d32;
                                            @elseif($ressource->type == 'Outillage') rgba(33, 150, 243, 0.1); color: #1565c0;
                                            @elseif($ressource->type == 'Engrais') rgba(255, 152, 0, 0.1); color: #ef6c00;
                                            @elseif($ressource->type == 'Équipement') rgba(156, 39, 176, 0.1); color: #7b1fa2;
                                            @else rgba(158, 158, 158, 0.1); color: #424242; @endif">
                                        {{ $ressource->type }}
                                    </span>
                                </td>
                                <td class="py-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="flex-grow-1">
                                            <div class="progress" style="height: 8px; border-radius: 10px; background: #e0e0e0;">
                                                @php
                                                    $max = max(100, $ressource->quantite);
                                                    $width = ($ressource->quantite / $max) * 100;
                                                    $color = $ressource->quantite < 10 ? 'bg-danger' : ($ressource->quantite < 50 ? 'bg-warning' : 'bg-success');
                                                @endphp
                                                <div class="progress-bar" role="progressbar" 
                                                    style="width: {{ $width }}%; background: linear-gradient(135deg, 
                                                        @if($ressource->quantite < 10) #f44336, #e57373
                                                        @elseif($ressource->quantite < 50) #ff9800, #ffb74d
                                                        @else #4caf50, #66bb6a @endif); 
                                                    border-radius: 10px;" 
                                                    aria-valuenow="{{ $width }}" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                        <small class="fw-bold" 
                                            style="color: 
                                                @if($ressource->quantite < 10) #d32f2f
                                                @elseif($ressource->quantite < 50) #ef6c00
                                                @else #2e7d32 @endif; 
                                            min-width: 45px;">
                                            {{ $ressource->quantite }}
                                        </small>
                                    </div>
                                </td>
                                <td class="py-4">
                                    @if($ressource->activite)
                                        <span class="badge bg-light text-dark px-3 py-2">{{ $ressource->activite->nom }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="py-4">
                                    @if($ressource->fournisseur)
                                        <div class="d-flex align-items-center">
                                            <i class="ti ti-truck text-muted me-2"></i>
                                            <span>{{ $ressource->fournisseur->nom }}</span>
                                        </div>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="pe-4 py-4 text-end">
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-sm btn-light rounded-start-pill px-3" 
                                                onclick="openDetailsModal({{ $ressource->idRessource }})"
                                                data-bs-tooltip="tooltip" title="Details">
                                            <i class="ti ti-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-light rounded-0 px-3" 
                                                onclick="openEditModal({{ $ressource->idRessource }})"
                                                data-bs-tooltip="tooltip" title="Edit">
                                            <i class="ti ti-edit"></i>
                                        </button>
                                        <form action="{{ route('ressources.destroy', $ressource->idRessource) }}" 
                                              method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-light rounded-end-pill px-3 text-danger" 
                                                    onclick="return confirm('Do you really want to delete this resource?')"
                                                    data-bs-tooltip="tooltip" title="Delete">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="text-muted small">
            Displaying {{ $ressources->firstItem() ?? 0 }} to {{ $ressources->lastItem() ?? 0 }} of {{ $ressources->total() }} resources
        </div>
        <div>
            <nav aria-label="Resource pagination">
                <ul class="pagination mb-0">
                    @if ($ressources->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link">Previous</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $ressources->previousPageUrl() }}">Previous</a>
                        </li>
                    @endif

                    @foreach ($ressources->getUrlRange(1, $ressources->lastPage()) as $page => $url)
                        <li class="page-item {{ $ressources->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    @if ($ressources->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $ressources->nextPageUrl() }}">Next</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link">Next</span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>

</div>

<!-- Create Modal -->
<div class="modal fade" id="createRessource" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <form method="POST" action="{{ route('ressources.store') }}" id="createForm">
            @csrf
            <div class="modal-content border-0" style="border-radius: 20px; overflow: hidden;">
                <div class="modal-header" style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9); border-bottom: none; padding: 2rem 2rem 1rem;">
                    <div class="d-flex align-items-center w-100">
                        <div class="flex-shrink-0 me-3">
                            <div class="p-3 rounded-circle" style="background: rgba(255,255,255,0.3);">
                                <i class="ti ti-plus text-success fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="modal-title fw-bold mb-0" style="color: #2e7d32;">New Resource</h5>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Resource name <span class="text-danger">*</span></label>
                            <input type="text" name="nom" id="nomAjout" class="form-control" style="border-radius: 12px;">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Type <span class="text-danger">*</span></label>
                            <select name="type" class="form-select" style="border-radius: 12px;">
                                <option value="">Select type</option>
                                <option value="Matériel">Material</option>
                                <option value="Végétal">Plant</option>
                                <option value="Engrais">Fertilizer</option>
                                <option value="Outillage">Tools</option>
                                <option value="Équipement">Equipment</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Quantity <span class="text-danger">*</span></label>
                            <input type="number" name="quantite" class="form-control" style="border-radius: 12px;">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Associated activity</label>
                            <select name="idActivite" class="form-select" style="border-radius: 12px;">
                                <option value="">-- No activity --</option>
                                @foreach($activites as $activite)
                                    <option value="{{ $activite->idActivite }}">{{ $activite->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 mb-3">
                            <label class="form-label fw-semibold">Supplier</label>
                            <select name="idFournisseur" class="form-select" style="border-radius: 12px;">
                                <option value="">-- No supplier --</option>
                                @foreach($fournisseurs as $fournisseur)
                                    <option value="{{ $fournisseur->idFournisseur }}">{{ $fournisseur->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- AI Analysis Button -->
                    <div class="row mb-3">
                        <div class="col-12">
                            <button type="button" class="btn btn-outline-success" id="analyzeAI" style="border-radius: 12px;">
                                <i class="ti ti-leaf me-1"></i> Analyze with AI
                            </button>
                        </div>
                    </div>

                    <!-- AI Results -->
                    <div class="row mb-3" id="aiSuggestions" style="display:none;">
                        <div class="col-12">
                            <h6 class="text-success mb-3">
                                <i class="ti ti-robot me-2"></i>Ecological AI Recommendations
                            </h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Detected material</label>
                                    <textarea id="aiMaterial" class="form-control" rows="2" readonly style="border-radius: 12px;"></textarea>
                                    <input type="hidden" name="material" id="inputMaterial">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Estimated CO₂ impact</label>
                                    <textarea id="aiCo2" class="form-control" rows="2" readonly style="border-radius: 12px;"></textarea>
                                    <input type="hidden" name="co2_impact" id="inputCo2">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">CO₂ - Usage</label>
                                    <textarea id="aiCo2Use" class="form-control" rows="2" readonly style="border-radius: 12px;"></textarea>
                                    <input type="hidden" name="co2_use" id="inputCo2Use">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">CO₂ - Production</label>
                                    <textarea id="aiCo2Prod" class="form-control" rows="2" readonly style="border-radius: 12px;"></textarea>
                                    <input type="hidden" name="co2_prod" id="inputCo2Prod">
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Recommended ecological alternative</label>
                                    <textarea id="aiAlternative" class="form-control" rows="3" readonly style="border-radius: 12px;"></textarea>
                                    <input type="hidden" name="eco_alternative" id="inputAlternative">
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Recommended supplier</label>
                                    <textarea id="aiSupplier" class="form-control" rows="2" readonly style="border-radius: 12px;"></textarea>
                                    <input type="hidden" name="recommended_supplier" id="inputSupplier">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 bg-light">
                    <div class="d-flex gap-2 w-100">
                       <button type="submit" class="btn btn-success flex-fill btn-sm" style="border-radius: 10px; padding: 8px 12px; background-color: #4caf50; border-color: #4caf50;">
    <i class="ti ti-check me-1"></i>Create
</button>
                        <button type="button" class="btn btn-light flex-fill" data-bs-dismiss="modal">
                            <i class="ti ti-x me-2"></i> Cancel
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modals for each resource (dynamically generated) -->
@foreach($ressources as $ressource)
<!-- Details Modal -->
<div class="modal fade" id="detailsRessource{{ $ressource->idRessource }}" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0" style="border-radius: 20px; overflow: hidden;">
            <div class="modal-header" style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9); border-bottom: none; padding: 2rem 2rem 1rem;">
                <div class="d-flex align-items-center w-100">
                    <div class="flex-shrink-0 me-3">
                        <div class="p-3 rounded-circle" style="background: rgba(255,255,255,0.3);">
                            <i class="ti ti-package text-primary fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="modal-title fw-bold mb-1" style="color: #2e7d32;">{{ $ressource->nom }}</h5>
                        <span class="badge rounded-pill px-3 py-2 fw-normal" 
                            style="background: 
                                @if($ressource->type == 'Végétal') rgba(76, 175, 80, 0.1); color: #2e7d32;
                                @elseif($ressource->type == 'Outillage') rgba(33, 150, 243, 0.1); color: #1565c0;
                                @elseif($ressource->type == 'Engrais') rgba(255, 152, 0, 0.1); color: #ef6c00;
                                @elseif($ressource->type == 'Équipement') rgba(156, 39, 176, 0.1); color: #7b1fa2;
                                @else rgba(158, 158, 158, 0.1); color: #424242; @endif">
                            {{ $ressource->type }}
                        </span>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body p-4">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="fw-semibold text-muted small">QUANTITY</label>
                        <p class="mb-2">
                            <i class="ti ti-package me-2" style="color: #4caf50;"></i>
                            {{ $ressource->quantite }} units
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="fw-semibold text-muted small">ASSOCIATED ACTIVITY</label>
                        <p class="mb-2">
                            <i class="ti ti-activity me-2" style="color: #4caf50;"></i>
                            {{ $ressource->activite?->nom ?? 'None' }}
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="fw-semibold text-muted small">SUPPLIER</label>
                        <p class="mb-2">
                            <i class="ti ti-truck me-2" style="color: #4caf50;"></i>
                            {{ $ressource->fournisseur?->nom ?? 'None' }}
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="fw-semibold text-muted small">DETECTED MATERIAL</label>
                        <p class="mb-2">
                            <i class="ti ti-box me-2" style="color: #4caf50;"></i>
                            {{ $ressource->material ?? 'Not analyzed' }}
                        </p>
                    </div>
                </div>

                <!-- Environmental impact -->
                <div class="mb-4">
                    <label class="fw-semibold text-muted small mb-3">ENVIRONMENTAL IMPACT</label>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="border rounded p-3 text-center">
                                <small class="text-muted d-block">Total CO₂ impact</small>
                                <span class="fw-bold text-success">{{ $ressource->co2_impact ?? 'Not estimated' }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border rounded p-3 text-center">
                                <small class="text-muted d-block">Production</small>
                                <span class="fw-bold">{{ $ressource->co2_prod ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border rounded p-3 text-center">
                                <small class="text-muted d-block">Usage</small>
                                <span class="fw-bold">{{ $ressource->co2_use ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                @if($ressource->eco_alternative && $ressource->eco_alternative !== 'Aucune suggestion')
                <div class="mb-3">
                    <label class="fw-semibold text-muted small">ECOLOGICAL ALTERNATIVE</label>
                    <div class="bg-light p-3 rounded">
                        <p class="mb-0">{{ $ressource->eco_alternative }}</p>
                    </div>
                </div>
                @endif

                @if($ressource->recommended_supplier && $ressource->recommended_supplier !== 'Recommandation non disponible')
                <div class="mb-3">
                    <label class="fw-semibold text-muted small">RECOMMENDED SUPPLIER</label>
                    <div class="d-flex align-items-center bg-light p-3 rounded">
                        <i class="ti ti-store text-success me-3"></i>
                        <div>
                            <p class="mb-1 fw-bold">{{ $ressource->recommended_supplier }}</p>
                            <small class="text-muted">Suggestion based on sustainability</small>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="modal-footer border-top-0 bg-light">
                <div class="d-flex gap-2 w-100">
                   <button type="button" class="btn btn-primary flex-fill" 
        onclick="closeAndOpenEdit({{ $ressource->idRessource }})"
        style="background-color: #4caf50; border-color: #4caf50;">
    <i class="ti ti-edit me-2"></i> Edit
</button>
                    <button type="button" class="btn btn-light flex-fill" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editRessource{{ $ressource->idRessource }}" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <form method="POST" action="{{ route('ressources.update', $ressource->idRessource) }}">
            @csrf
            @method('PUT')
            <div class="modal-content border-0" style="border-radius: 20px; overflow: hidden;">
                <div class="modal-header" style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9); border-bottom: none; padding: 2rem 2rem 1rem;">
                    <div class="d-flex align-items-center w-100">
                        <div class="flex-shrink-0 me-3">
                            <div class="p-3 rounded-circle" style="background: rgba(255,255,255,0.3);">
                                <i class="ti ti-edit text-primary fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="modal-title fw-bold mb-0" style="color: #2e7d32;">Edit Resource</h5>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Resource name</label>
                            <input type="text" name="nom" value="{{ $ressource->nom }}" 
                                   class="form-control" style="border-radius: 12px;">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Type</label>
                            <select name="type" class="form-select" required style="border-radius: 12px;">
                                <option value="Matériel" {{ $ressource->type == 'Matériel' ? 'selected' : '' }}>Material</option>
                                <option value="Végétal" {{ $ressource->type == 'Végétal' ? 'selected' : '' }}>Plant</option>
                                <option value="Engrais" {{ $ressource->type == 'Engrais' ? 'selected' : '' }}>Fertilizer</option>
                                <option value="Outillage" {{ $ressource->type == 'Outillage' ? 'selected' : '' }}>Tools</option>
                                <option value="Équipement" {{ $ressource->type == 'Équipement' ? 'selected' : '' }}>Equipment</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Quantity</label>
                            <input type="number" name="quantite" value="{{ $ressource->quantite }}" 
                                   class="form-control" style="border-radius: 12px;">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Associated activity</label>
                            <select name="idActivite" class="form-select" style="border-radius: 12px;">
                                <option value="">-- No activity --</option>
                                @foreach($activites as $activite)
                                    <option value="{{ $activite->idActivite }}" 
                                        {{ $ressource->idActivite == $activite->idActivite ? 'selected' : '' }}>
                                        {{ $activite->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label class="form-label fw-semibold">Supplier</label>
                            <select name="idFournisseur" class="form-select" style="border-radius: 12px;">
                                <option value="">-- No supplier --</option>
                                @foreach($fournisseurs as $fournisseur)
                                    <option value="{{ $fournisseur->idFournisseur }}" 
                                        {{ $ressource->idFournisseur == $fournisseur->idFournisseur ? 'selected' : '' }}>
                                        {{ $fournisseur->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 bg-light">
                    <div class="d-flex gap-2 w-100">
                        <button type="submit" class="btn btn-primary flex-fill" style="background-color: #4caf50; border-color: #4caf50;">
    <i class="ti ti-check me-2"></i> Update
</button>
                        <button type="button" class="btn btn-outline-secondary flex-fill btn-sm" data-bs-dismiss="modal" style="border-radius: 10px; padding: 8px 12px;">
    <i class="ti ti-x me-1"></i>Cancel
</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach

<!-- Scripts for dynamic filtering -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // --- TABLE FILTERING ---
    const searchInput = document.getElementById('searchInput');
    const typeFilter = document.getElementById('typeFilter');
    const quantityFilter = document.getElementById('quantityFilter');
    const activityFilter = document.getElementById('activityFilter');
    const resetButton = document.getElementById('resetFilters');
    const tableRows = document.querySelectorAll('#ressourcesTable tbody tr');

    function filterTable() {
        const searchValue = searchInput.value.toLowerCase();
        const typeValue = typeFilter.value;
        const quantityValue = quantityFilter.value;
        const activityValue = activityFilter.value;

        tableRows.forEach(row => {
            const name = row.cells[0].textContent.toLowerCase();
            const type = row.dataset.type;
            const quantity = parseInt(row.dataset.quantite);
            const activity = row.dataset.activite;

            let showRow = true;

            if (searchValue && !name.includes(searchValue)) showRow = false;
            if (typeValue && type !== typeValue) showRow = false;

            if (quantityValue) {
                if (quantityValue === 'low' && quantity >= 10) showRow = false;
                if (quantityValue === 'medium' && (quantity < 10 || quantity > 50)) showRow = false;
                if (quantityValue === 'high' && quantity <= 50) showRow = false;
            }

            if (activityValue && activity !== activityValue) showRow = false;

            row.style.display = showRow ? '' : 'none';
        });
    }

    searchInput.addEventListener('input', filterTable);
    typeFilter.addEventListener('change', filterTable);
    quantityFilter.addEventListener('change', filterTable);
    activityFilter.addEventListener('change', filterTable);
    resetButton.addEventListener('click', function() {
        searchInput.value = '';
        typeFilter.value = '';
        quantityFilter.value = '';
        activityFilter.value = '';
        filterTable();
    });

    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-tooltip="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
});

// Functions to handle modals
function openDetailsModal(id) {
    const modal = new bootstrap.Modal(document.getElementById('detailsRessource' + id));
    modal.show();
}

function openEditModal(id) {
    const modal = new bootstrap.Modal(document.getElementById('editRessource' + id));
    modal.show();
}

function closeAndOpenEdit(id) {
    // Close details modal
    const detailsModal = bootstrap.Modal.getInstance(document.getElementById('detailsRessource' + id));
    detailsModal.hide();
    
    // Open edit modal after a short delay
    setTimeout(() => {
        openEditModal(id);
    }, 300);
}
</script>

<!-- AJAX Validation Script -->
<script>
$(document).ready(function() {

    // Submit form with AJAX
    $('#createForm').on('submit', function(e) {
        e.preventDefault();
        let form = $(this);
        form.find('.text-danger').remove();

        $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: form.serialize(),
            success: function(response) {
                $('#createRessource').modal('hide');
                alert('Resource added successfully ✅');
                location.reload();
            },
            error: function(xhr) {
                if(xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, messages) {
                        let input = form.find('[name="'+key+'"]');
                        input.after('<span class="text-danger">'+messages[0]+'</span>');
                    });
                } else {
                    alert('An error occurred!');
                }
            }
        });
    });

    // Real-time input validation
    $('#createForm input, #createForm select').on('input change', function() {
        let field = $(this);
        let formData = {};
        formData[field.attr('name')] = field.val();

        $.ajax({
            type: 'POST',
            url: '{{ route("ressources.store") }}',
            data: formData,
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            success: function() { 
                field.next('.text-danger').remove();
            },
            error: function(xhr) {
                if(xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    field.next('.text-danger').remove();
                    if(errors[field.attr('name')]) {
                        field.after('<span class="text-danger">'+errors[field.attr('name')][0]+'</span>');
                    }
                }
            }
        });
    });

});
</script>

<script>
document.getElementById('analyzeAI').addEventListener('click', async function() {
    const nom = document.querySelector('[id="nomAjout"]').value.trim();
    
    if (!nom) {
        alert('Please fill in the resource name before analysis.');
        return;
    }

    const btn = this;
    btn.disabled = true;
    btn.textContent = "Analysis in progress... 🌿";

    try {
        const response = await fetch("{{ route('ressources.analyze') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ nom })
        });

        const data = await response.json();

        if (data.error) {
            alert("Error: " + data.error);
        } else {
            document.getElementById('aiSuggestions').style.display = 'flex';

            document.getElementById('aiMaterial').value = data.material || "Unknown";
            document.getElementById('aiCo2').value = data.co2_impact ?? "—";
            document.getElementById('aiCo2Use').value = data.co2_use ?? "—";
            document.getElementById('aiCo2Prod').value = data.co2_prod ?? "—";
            
            document.getElementById('aiAlternative').value = data.eco_alternative || "No suggestion";
            document.getElementById('aiSupplier').value = data.recommended_supplier || "Not available";

            // Storage for backend submission
            document.getElementById('inputMaterial').value = data.material || "";
            document.getElementById('inputCo2').value = data.co2_impact || "";
            document.getElementById('inputCo2Use').value = data.co2_use ?? "—";
            document.getElementById('inputCo2Prod').value = data.co2_prod ?? "—";

            document.getElementById('inputAlternative').value = data.eco_alternative || "";
            document.getElementById('inputSupplier').value = data.recommended_supplier || "";
        }
    } catch (err) {
        console.error(err);
        alert("Error during AI analysis.");
    } finally {
        btn.disabled = false;
        btn.textContent = "Analyze with AI 🤖";
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

.form-control, .form-select {
    border-radius: 12px;
    border: 1px solid #e0e0e0;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.25);
    border-color: #4caf50;
}

.badge {
    font-weight: 500;
}
</style>
@endsection