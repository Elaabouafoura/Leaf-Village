@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-5 mt-3">
        <div>
            <div class="d-flex align-items-center mb-2">
                <div class="p-3 rounded-circle me-3" style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9);">
                    <i class="ti ti-edit fs-4" style="color: #4caf50;"></i>
                </div>
                <div>
                    <h1 class="h3 mb-1 fw-bold text-gradient" style="color: #2e7d32;">Edit Project</h1>
                    <p class="text-muted mb-0">Update project details for: 
                        <span class="text-success fw-semibold">{{ $project->nom }}</span>
                    </p>
                </div>
            </div>
        </div>
        <a href="{{ route('projects.index') }}" class="btn btn-lg shadow-sm hover-lift" 
           style="border: 1px solid #81c784; color: #2e7d32; border-radius: 12px;">
            <i class="ti ti-arrow-left me-2"></i> Back to Projects
        </a>
    </div>

    <!-- Notifications -->
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

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-5" role="alert" 
             style="background: linear-gradient(135deg, #ffebee, #ffcdd2); border: none; border-radius: 16px; color: #b71c1c;">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <i class="ti ti-alert-triangle fs-5 me-3"></i>
                </div>
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

    <!-- Main Content -->
    <div class="row g-5">
        <!-- Form Section -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm hover-shadow" style="border-radius: 20px; background: #f8fdf9;">
                <div class="card-header py-4 border-bottom-0" 
                     style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9); border-radius: 20px 20px 0 0;">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle me-3" style="background: rgba(255,255,255,0.3);">
                                <i class="ti ti-folder text-primary fs-5"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="card-title mb-1 fw-bold" style="color: #2e7d32;">Project Information</h5>
                            <p class="text-muted mb-0 small">Update the details of your project</p>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-5">
                    <form action="{{ route('projects.update', $project) }}" method="POST" id="projectForm">
                        @csrf
                        @method('PATCH')

                       
                        <!-- Project Name & Budget -->
                        <div class="row g-4 mb-5">
                            <!-- Project Name -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold fs-6 mb-3">
                                    <i class="ti ti-building me-2" style="color: #4caf50;"></i>
                                    Project Name <span class="text-danger">*</span>
                                </label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light border-end-0 rounded-start-3">
                                        <i class="ti ti-edit text-muted"></i>
                                    </span>
                                    <input type="text" name="nom" class="form-control border-start-0 ps-3 rounded-end-3" 
                                           value="{{ old('nom', $project->nom) }}" 
                                           placeholder="Enter project name" 
                                           required
                                           oninput="updateCharCount(this, 'nameCount')">
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div class="form-text text-muted">
                                        <i class="ti ti-info-circle me-1"></i>
                                        The name should be descriptive and unique
                                    </div>
                                    <div class="text-muted small fw-semibold">
                                        <span id="nameCount" class="count-display">{{ strlen(old('nom', $project->nom)) }}</span>/100
                                    </div>
                                </div>
                            </div>

                            <!-- Budget -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold fs-6 mb-3">
                                    <i class="ti ti-currency-euro me-2" style="color: #4caf50;"></i>
                                    Budget
                                </label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light border-end-0 rounded-start-3">
                                        <i class="ti ti-cash text-muted"></i>
                                    </span>
                                    <input type="number" step="0.01" name="budget" class="form-control border-start-0 ps-3" 
                                           value="{{ old('budget', $project->budget) }}" 
                                           placeholder="0.00"
                                           
                                    <span class="input-group-text bg-light border-start-0 rounded-end-3">€</span>
                                </div>
                                <div class="form-text text-muted mt-3">
                                    <i class="ti ti-chart-bar me-1"></i>
                                    Enter the total project budget
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
                                <!-- Start Date -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Start Date</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 rounded-start-2">
                                            <i class="ti ti-calendar text-muted"></i>
                                        </span>
                                        <input type="date" name="dateDebut" class="form-control border-start-0 ps-2 rounded-end-2" 
                                               value="{{ old('dateDebut', $project->dateDebut ? \Carbon\Carbon::parse($project->dateDebut)->format('Y-m-d') : '') }}"
                                               id="startDate">
                                    </div>
                                    <div class="form-text text-muted mt-2">
                                        <i class="ti ti-clock me-1"></i>
                                        Project commencement date
                                    </div>
                                </div>

                                <!-- End Date -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">End Date</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 rounded-start-2">
                                            <i class="ti ti-calendar-off text-muted"></i>
                                        </span>
                                        <input type="date" name="dateFin" class="form-control border-start-0 ps-2 rounded-end-2" 
                                               value="{{ old('dateFin', $project->dateFin ? \Carbon\Carbon::parse($project->dateFin)->format('Y-m-d') : '') }}"
                                               id="endDate">
                                    </div>
                                    <div class="form-text text-muted mt-2">
                                        <i class="ti ti-flag me-1"></i>
                                        Project completion date
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Description Section -->
                        <div class="mb-5">
                            <h6 class="fw-semibold mb-4" style="color: #2e7d32;">
                                <i class="ti ti-notes me-2"></i>
                                Project Description
                            </h6>
                            <div class="input-group">
                                <span class="input-group-text bg-light align-items-start pt-3 border-end-0 rounded-start-2">
                                    <i class="ti ti-edit text-muted"></i>
                                </span>
                                <textarea name="description" class="form-control border-start-0 ps-2 rounded-end-2" 
                                          rows="5" 
                                          placeholder="Describe the project objectives, scope, deliverables, and key details..."
                                          oninput="updateCharCount(this, 'descCount')">{{ old('description', $project->description) }}</textarea>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div class="form-text text-muted">
                                    <i class="ti ti-info-circle me-1"></i>
                                    Provide a detailed description of the project
                                </div>
                                <div class="text-muted small fw-semibold">
                                    <span id="descCount" class="count-display">{{ strlen(old('description', $project->description)) }}</span>/1000
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex gap-3 justify-content-end pt-5 border-top">
                            <a href="{{ route('projects.index') }}" class="btn btn-lg px-4 hover-lift" 
                               style="border: 1px solid #81c784; color: #2e7d32; border-radius: 12px;">
                                <i class="ti ti-x me-2"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-lg px-5 hover-lift" 
                                    style="background: linear-gradient(135deg, #4caf50, #66bb6a); color: #fff; border: none; border-radius: 12px;" 
                                    id="submitBtn">
                                <i class="ti ti-check me-2"></i> Update Project
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar Section -->
        <div class="col-lg-4">
            <!-- Project Summary Card -->
            <div class="card border-0 shadow-sm hover-shadow mb-4" style="border-radius: 20px; background: #f8fdf9;">
                <div class="card-header py-4 border-bottom-0" 
                     style="background: linear-gradient(135deg, #e3f2fd, #bbdefb); border-radius: 20px 20px 0 0;">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle me-3" style="background: rgba(255,255,255,0.3);">
                                <i class="ti ti-info-circle fs-5" style="color: #1976d2;"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="card-title mb-1 fw-bold" style="color: #1976d2;">Project Summary</h6>
                            <p class="text-muted mb-0 small">Current project details</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex flex-column gap-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="p-2 rounded me-3" style="background: rgba(76, 175, 80, 0.1);">
                                    <i class="ti ti-calendar text-success fs-5"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Created</small>
                                    <span class="fw-bold" style="color: #2e7d32;">
                                        {{ $project->created_at->format('M d, Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="p-2 rounded me-3" style="background: rgba(25, 118, 210, 0.1);">
                                    <i class="ti ti-clock text-primary fs-5"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Last Updated</small>
                                    <span class="fw-bold" style="color: #1976d2;">
                                        {{ $project->updated_at->format('M d, Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="p-2 rounded me-3" style="background: rgba(194, 24, 91, 0.1);">
                                    <i class="ti ti-currency-euro text-pink fs-5"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Current Budget</small>
                                    <span class="fw-bold" style="color: #c2185b;">
                                        {{ $project->budget ? number_format($project->budget, 2) . ' €' : 'Not set' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Editing Tips Card -->
            <div class="card border-0 shadow-sm hover-shadow" style="border-radius: 20px; background: #f8fdf9;">
                <div class="card-header py-4 border-bottom-0" 
                     style="background: linear-gradient(135deg, #fff3e0, #ffcc80); border-radius: 20px 20px 0 0;">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle me-3" style="background: rgba(255,255,255,0.3);">
                                <i class="ti ti-lightbulb fs-5" style="color: #f57c00;"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="card-title mb-1 fw-bold" style="color: #f57c00;">Editing Tips</h6>
                            <p class="text-muted mb-0 small">Best practices for updates</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0 mt-1">
                                <i class="ti ti-refresh text-warning me-2"></i>
                            </div>
                            <div class="flex-grow-1">
                                <small class="text-muted">Update dates if project timeline changes</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0 mt-1">
                                <i class="ti ti-coin text-warning me-2"></i>
                            </div>
                            <div class="flex-grow-1">
                                <small class="text-muted">Adjust budget for scope changes</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0 mt-1">
                                <i class="ti ti-notes text-warning me-2"></i>
                            </div>
                            <div class="flex-grow-1">
                                <small class="text-muted">Keep description up to date</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0 mt-1">
                                <i class="ti ti-alert-triangle text-warning me-2"></i>
                            </div>
                            <div class="flex-grow-1">
                                <small class="text-muted">Review all changes before saving</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    function updateCharCount(input, countElementId) {
        const count = input.value.length;
        const maxLength = input.name === 'nom' ? 100 : 1000;
        const countElement = document.getElementById(countElementId);
        countElement.textContent = count;

        if (count > maxLength * 0.9) {
            countElement.classList.add('text-danger');
            countElement.classList.remove('text-warning');
        } else if (count > maxLength * 0.8) {
            countElement.classList.add('text-warning');
            countElement.classList.remove('text-danger');
        } else {
            countElement.classList.remove('text-warning', 'text-danger');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const startDate = document.getElementById('startDate');
        const endDate = document.getElementById('endDate');
        const form = document.getElementById('projectForm');

        // Initialize character counts
        updateCharCount(document.querySelector('[name="nom"]'), 'nameCount');
        updateCharCount(document.querySelector('[name="description"]'), 'descCount');

        // Date validation
        if (startDate && endDate) {
            startDate.addEventListener('change', function() {
                if (endDate.value && this.value > endDate.value) {
                    endDate.value = '';
                    showToast('End date adjusted to be after start date', 'warning');
                }
            });

            endDate.addEventListener('change', function() {
                if (startDate.value && this.value < startDate.value) {
                    this.value = '';
                    showToast('End date must be after start date', 'error');
                }
            });
        }

        // Form submission handling
        form.addEventListener('submit', function() {
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="ti ti-loader me-2"></i> Updating...';
        });

        // Add focus effects to form controls
        const formControls = document.querySelectorAll('.form-control, .form-select');
        formControls.forEach(control => {
            control.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            control.addEventListener('blur', function() {
                this.parentElement.classList.remove('focused');
            });
        });
    });

    function showToast(message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = `alert alert-${type === 'error' ? 'danger' : type} alert-dismissible fade show position-fixed`;
        toast.style.cssText = 'top: 20px; right: 20px; z-index: 1055; min-width: 300px; border-radius: 12px;';
        toast.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="ti ti-${type === 'error' ? 'alert-triangle' : 'info-circle'} me-2 fs-5"></i>
                <div class="flex-grow-1">${message}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        document.body.appendChild(toast);
        setTimeout(() => {
            if (toast.parentNode) toast.parentNode.removeChild(toast);
        }, 5000);
    }
</script>
@endpush

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
        box-shadow: 0 6px 20px rgba(76, 175, 80, 0.2);
    }
    
    .form-control, .form-select {
        border-radius: 8px;
        transition: all 0.3s ease;
        border: 1px solid #e0e0e0;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #4caf50;
        box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.15);
        transform: translateY(-1px);
    }
    
    .input-group:focus-within .input-group-text {
        background-color: #e8f5e9;
        border-color: #4caf50;
        color: #2e7d32;
    }
    
    .input-group-text {
        transition: all 0.3s ease;
        border-color: #e0e0e0;
    }
    
    .count-display {
        font-weight: 600;
        padding: 2px 8px;
        border-radius: 12px;
        background: #f5f5f5;
    }
    
    /* Progress Steps */
    .step-step {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        z-index: 2;
    }
    
    .step-number {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #e0e0e0;
        color: #9e9e9e;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        margin-bottom: 8px;
        transition: all 0.3s ease;
    }
    
    .step-step.active .step-number {
        background: linear-gradient(135deg, #4caf50, #66bb6a);
        color: white;
        box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
    }
    
    .step-step.completed .step-number {
        background: #4caf50;
        color: white;
    }
    
    .step-label {
        font-size: 0.8rem;
        color: #9e9e9e;
        font-weight: 500;
    }
    
    .step-step.active .step-label {
        color: #2e7d32;
        font-weight: 600;
    }
    
    .step-connector {
        flex: 1;
        height: 2px;
        background: #e0e0e0;
        margin: 0 10px;
        position: absolute;
        top: 20px;
        left: 50%;
        right: -50%;
        z-index: 1;
    }
    
    .step-step.completed + .step-connector {
        background: #4caf50;
    }
    
    .step-connector.completed {
        background: #4caf50;
    }
    
    /* Focus states */
    .input-group.focused .input-group-text {
        background-color: #e8f5e9;
        border-color: #4caf50;
    }
</style>
@endpush