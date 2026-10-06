@extends('layouts.admin')

@section('title', 'Profil Administrateur - Green Spaces')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-gradient-success shadow-success border-0">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="text-white mb-1">Profil Administrateur</h2>
                            <p class="text-white opacity-8 mb-0">Gérez vos informations et paramètres de compte</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="bg-white bg-opacity-20 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                <i class="fas fa-user-cog text-white fs-2"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Left Column - Profile Information -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white pb-0">
                    <h5 class="mb-0 text-success">
                        <i class="fas fa-user me-2"></i>Informations Personnelles
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-success fw-semibold">Nom</label>
                            <div class="form-control bg-light border-0">
                                {{ auth()->user()->nom }}
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-success fw-semibold">Prénom</label>
                            <div class="form-control bg-light border-0">
                                {{ auth()->user()->prenom }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-success fw-semibold">Email</label>
                            <div class="form-control bg-light border-0">
                                {{ auth()->user()->email }}
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-success fw-semibold">Téléphone</label>
                            <div class="form-control bg-light border-0">
                                {{ auth()->user()->telephone ?? 'Non renseigné' }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-success fw-semibold">Rôle</label>
                            <div class="form-control bg-light border-0 text-capitalize">
                                <span class="badge bg-success">{{ auth()->user()->role }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-success fw-semibold">Date d'Inscription</label>
                            <div class="form-control bg-light border-0">
                                {{ \Carbon\Carbon::parse(auth()->user()->dateInscription)->format('d/m/Y') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Column - Actions & Quick Stats -->
        <div class="col-lg-4 mb-4">
            <!-- Quick Actions -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white pb-0">
                    <h5 class="mb-0 text-success">
                        <i class="fas fa-bolt me-2"></i>Actions Rapides
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.password.reset') }}" class="btn btn-success btn-lg">
                            <i class="fas fa-key me-2"></i>Changer Mot de Passe
                        </a>
                        <a href="{{ route('admin.profile.showUpdate') }}" class="btn btn-outline-success btn-lg">
                            <i class="fas fa-edit me-2"></i>Modifier Profil
                        </a>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<style>
.bg-gradient-success {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%) !important;
}

.bg-gradient-light-success {
    background: linear-gradient(135deg, #d4f8e8 0%, #f0fdf4 100%) !important;
}

.bg-gradient-light-info {
    background: linear-gradient(135deg, #e0f2fe 0%, #f0f9ff 100%) !important;
}

.bg-gradient-light-warning {
    background: linear-gradient(135deg, #fef3c7 0%, #fffbeb 100%) !important;
}

.bg-gradient-light-danger {
    background: linear-gradient(135deg, #fee2e2 0%, #fef2f2 100%) !important;
}

.shadow-success {
    box-shadow: 0 4px 20px rgba(56, 239, 125, 0.3) !important;
}

.timeline {
    position: relative;
}

.timeline-item {
    position: relative;
    padding-left: 20px;
}

.timeline-item:before {
    content: '';
    position: absolute;
    left: 0;
    top: 5px;
    width: 8px;
    height: 8px;
    background: #38ef7d;
    border-radius: 50%;
}

.timeline-content {
    margin-left: 10px;
}

.card {
    border-radius: 15px;
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1) !important;
}

.btn {
    border-radius: 10px;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-1px);
}
</style>
@endsection