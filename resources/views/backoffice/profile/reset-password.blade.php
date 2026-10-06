@extends('layouts.admin')

@section('title', 'Changer Mot de Passe - Green Spaces')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <!-- Header -->
            <div class="card bg-gradient-success shadow-success border-0 mb-4">
                <div class="card-body p-4 text-center">
                    <div class="bg-white bg-opacity-20 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-key text-white fs-2"></i>
                    </div>
                    <h2 class="text-white mb-1">Changer le Mot de Passe</h2>
                    <p class="text-white opacity-8 mb-0">Mettez à jour votre mot de passe pour sécuriser votre compte</p>
                </div>
            </div>

            <!-- Reset Password Card -->
            <div class="card shadow-lg border-0">
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.password.update') }}" method="POST" id="resetForm">
                        @csrf
                        @method('PUT')
                        
                        <!-- Current Password -->
                        <div class="mb-4">
                            <label for="current_password" class="form-label text-success fw-semibold">
                                <i class="fas fa-lock me-2"></i>Mot de Passe Actuel
                            </label>
                            <div class="input-group">
                                <input type="password" class="form-control form-control-lg" id="current_password" 
                                       name="current_password" placeholder="Entrez votre mot de passe actuel" required>
                                <button type="button" class="btn btn-outline-secondary" id="toggleCurrentPassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- New Password -->
                        <div class="mb-4">
                            <label for="new_password" class="form-label text-success fw-semibold">
                                <i class="fas fa-key me-2"></i>Nouveau Mot de Passe
                            </label>
                            <div class="input-group">
                                <input type="password" class="form-control form-control-lg" id="new_password" 
                                       name="new_password" placeholder="Entrez le nouveau mot de passe" required>
                                <button type="button" class="btn btn-outline-secondary" id="toggleNewPassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label for="new_password_confirmation" class="form-label text-success fw-semibold">
                                <i class="fas fa-key me-2"></i>Confirmer le Mot de Passe
                            </label>
                            <div class="input-group">
                                <input type="password" class="form-control form-control-lg" id="new_password_confirmation" 
                                       name="new_password_confirmation" placeholder="Confirmez le nouveau mot de passe" required>
                                <button type="button" class="btn btn-outline-secondary" id="toggleConfirmPassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="mt-2" id="passwordMatch"></div>
                        </div>


                        <!-- Action Buttons -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('admin.profile') }}" class="btn btn-outline-secondary btn-lg me-md-2">
                                <i class="fas fa-arrow-left me-2"></i>Retour
                            </a>
                            <button type="submit" class="btn btn-success btn-lg" id="submitBtn">
                                <i class="fas fa-save me-2"></i>Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Security Tips -->
            <div class="card bg-gradient-light-success border-0 mt-4">
                <div class="card-body">
                    <h6 class="text-success fw-semibold mb-3">
                        <i class="fas fa-lightbulb me-2"></i>Conseils de Sécurité
                    </h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <small><i class="fas fa-check text-success me-2"></i>Utilisez un mot de passe unique</small>
                        </li>
                        <li class="mb-2">
                            <small><i class="fas fa-check text-success me-2"></i>Évitez les informations personnelles</small>
                        </li>
                        <li class="mb-2">
                            <small><i class="fas fa-check text-success me-2"></i>Changez régulièrement votre mot de passe</small>
                        </li>
                        <li>
                            <small><i class="fas fa-check text-success me-2"></i>N'utilisez pas le même mot de passe sur plusieurs sites</small>
                        </li>
                    </ul>
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

.shadow-success {
    box-shadow: 0 4px 20px rgba(56, 239, 125, 0.3) !important;
}

.card {
    border-radius: 15px;
}

.btn {
    border-radius: 10px;
}

.form-control {
    border-radius: 10px;
}

.requirement-item.valid {
    color: #28a745;
}

.requirement-item.valid i {
    color: #28a745 !important;
}

.requirement-item.invalid {
    color: #6c757d;
}
</style>

@endsection