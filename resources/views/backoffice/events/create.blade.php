@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-urbangreen border-0">
                <!-- ✅ Header en vert Urbain Green -->
                <div class="card-header bg-success text-white py-4" style="background: linear-gradient(135deg, #2e7d32, #4caf50) !important;">
                    <div class="d-flex align-items-center">
                        <div class="urbangreen-icon-container me-3">
                            <i class="fas fa-seedling fa-2x"></i>
                        </div>
                        <div>
                            <h4 class="mb-1">Schedule a new event</h4>
                            <p class="mb-0 opacity-8">Let's sow the seeds of change together</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <!-- Photo -->
                            <div class="col-12 mb-4">
                                <label class="form-label fw-bold text-success">Event photo</label>
                                <div class="image-upload-container-urbangreen text-center">
                                    <div class="image-preview mb-3">
                                        <img id="imagePreview" 
                                             src="{{ old('photo_ai_path') ? old('photo_ai_path') : asset('images/default-upload.jpg') }}" 
                                             alt="Aperçu de l'image" 
                                             class="rounded-urbangreen shadow-sm"
                                             style="height: 200px; object-fit: cover; width: 100%;">
                                    </div>
                                    <input type="hidden" name="photo_ai_base64" id="photo_ai_base64">
                                    <input type="file" name="photo" id="photo" 
                                           class="form-control d-none" 
                                           accept="image/*">
                                    
                                    <!-- ✅ Boutons améliorés côte à côte -->
                                    <div class="d-flex flex-column flex-md-row gap-3 justify-content-center align-items-center">
                                        <button type="button" class="btn btn-upload-photo" 
                                                onclick="document.getElementById('photo').click()">
                                            <div class="btn-content">
                                                <i class="fas fa-cloud-upload-alt me-2"></i>
                                                <span>Upload Photo</span>
                                            </div>
                                            <div class="btn-hover-effect">
                                                <i class="fas fa-camera"></i>
                                            </div>
                                        </button>

                                        <button type="button" class="btn btn-generate-ai" id="generateAI">
                                            <div class="btn-content">
                                                <i class="fas fa-magic me-2"></i>
                                                <span>Generate with AI</span>
                                            </div>
                                            <div class="btn-hover-effect">
                                                <i class="fas fa-robot"></i>
                                            </div>
                                        </button>
                                    </div>

                                    <small class="text-muted d-block mt-3">
                                        Recommended format: JPG, PNG (max 2MB)
                                    </small>
                                </div>
                            </div>

                            <!-- Nom -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-success">
                                    <i class="fas fa-tag me-2 text-success"></i>
                                    Event Name *
                                </label>
                                <input type="text" name="nom" class="form-control form-control-urbangreen @error('nom') is-invalid @enderror" 
                                       value="{{ old('nom') }}" placeholder="Ex: Nettoyage du parc central" required>
                                @error('nom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Date -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-success">
                                    <i class="fas fa-calendar me-2 text-success"></i>
                                    Date *
                                </label>
                                <input type="date" name="date" class="form-control form-control-urbangreen @error('date') is-invalid @enderror" 
                                       value="{{ old('date') }}" required>
                                @error('date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Lieu -->
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold text-success">
                                    <i class="fas fa-map-marker-alt me-2 text-success"></i>
                                    location *
                                </label>
                                <input type="text" name="lieu" class="form-control form-control-urbangreen @error('lieu') is-invalid @enderror" 
                                       value="{{ old('lieu') }}" placeholder="Ex: Parc Central, Ville" required>
                                @error('lieu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Projet -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-success">
                                    <i class="fas fa-project-diagram me-2 text-success"></i>
                                    Associated project *
                                </label>
                                <select name="idProjet" class="form-select form-select-urbangreen @error('idProjet') is-invalid @enderror" required>
                                    <option value="">-- Sélectionner un projet --</option>
                                    @foreach($projets as $projet)
                                        <option value="{{ $projet->idProjet }}" 
                                                {{ old('idProjet') == $projet->idProjet ? 'selected' : '' }}>
                                            {{ $projet->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('idProjet')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="col-12 mb-4">
                                <label class="form-label fw-bold text-success">
                                    <i class="fas fa-file-alt me-2 text-success"></i>
                                    Description
                                </label>
                                <textarea name="description" class="form-control form-control-urbangreen @error('description') is-invalid @enderror" 
                                          rows="5" placeholder="Décrivez l'événement, ses objectifs, l'impact environnemental, etc...">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="d-flex gap-3 justify-content-end pt-4 border-top border-success-subtle">
                            <a href="{{ route('events.index') }}" class="btn btn-outline-secondary btn-lg">
                                <i class="fas fa-arrow-left me-2"></i>Return
                            </a>
                            <button type="submit" class="btn btn-success btn-lg" style="background: linear-gradient(135deg, #2e7d32, #4caf50); border: none;">
                                <i class="fas fa-seedling me-2"></i>Schedule the event
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Prévisualisation de l'image
document.getElementById('photo').addEventListener('change', function(e) {
    const preview = document.getElementById('imagePreview');
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) { preview.src = e.target.result; }
        reader.readAsDataURL(file);
    }
});

document.getElementById('generateAI').addEventListener('click', async function() {
    const nom = document.querySelector('input[name="nom"]').value.trim();
    const description = document.querySelector('textarea[name="description"]').value.trim();

    // ✅ Vérification des champs requis
    if (!nom || !description) {
        // Création d'une alerte personnalisée
        const alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-warning alert-dismissible fade show custom-alert';
        alertDiv.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-triangle me-3"></i>
                <div>
                    <strong>Champs requis manquants</strong><br>
                    Veuillez remplir le nom de l'événement ET la description pour générer une image avec l'IA.
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        // Insertion de l'alerte en haut du formulaire
        const cardBody = document.querySelector('.card-body');
        cardBody.insertBefore(alertDiv, cardBody.firstChild);
        
        // Auto-dismiss après 5 secondes
        setTimeout(() => {
            if (alertDiv.parentElement) {
                alertDiv.remove();
            }
        }, 5000);
        
        return;
    }

    const preview = document.getElementById('imagePreview');
    const generateBtn = document.getElementById('generateAI');
    
    // Sauvegarde du contenu original du bouton
    const originalContent = generateBtn.innerHTML;
    
    // Affichage du loader
    generateBtn.innerHTML = `
        <div class="btn-content">
            <div class="spinner-border spinner-border-sm me-2" role="status"></div>
            <span>Generation...</span>
        </div>
    `;
    generateBtn.disabled = true;

    preview.src = "{{ asset('images/loading.gif') }}";

    try {
        const response = await fetch("{{ route('events.generateAI') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ 
                nom, 
                description, 
                lieu: document.querySelector('input[name="lieu"]').value.trim(),
                date: document.querySelector('input[name="date"]').value.trim()
            })
        });

        const data = await response.json();

        if (data.image_base64) {
            // Affiche l'image en preview
            preview.src = "data:image/png;base64," + data.image_base64;
            // Remplit l'input hidden pour la stocker dans la DB
            document.getElementById('photo_ai_base64').value = data.image_base64;
            
            // Message de succès
            showAlert('success', 'Image générée avec succès !');
        } else {
            preview.src = "{{ asset('images/default-upload.jpg') }}";
            showAlert('error', 'Erreur : impossible de générer l\'image.');
        }
    } catch (error) {
        console.error(error);
        preview.src = "{{ asset('images/default-upload.jpg') }}";
        showAlert('error', 'Erreur de connexion au serveur.');
    } finally {
        // Restauration du bouton
        generateBtn.innerHTML = originalContent;
        generateBtn.disabled = false;
    }
});

// Fonction pour afficher les alertes
function showAlert(type, message) {
    const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
    
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert ${alertClass} alert-dismissible fade show custom-alert`;
    alertDiv.innerHTML = `
        <div class="d-flex align-items-center">
            <i class="fas ${icon} me-3"></i>
            <div>${message}</div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    const cardBody = document.querySelector('.card-body');
    cardBody.insertBefore(alertDiv, cardBody.firstChild);
    
    setTimeout(() => {
        if (alertDiv.parentElement) {
            alertDiv.remove();
        }
    }, 4000);
}
</script>

<style>
:root {
    --urbangreen-primary: #2e7d32;
    --urbangreen-secondary: #4caf50;
    --urbangreen-light: #e8f5e9;
    --urbangreen-lighter: #f1f8e9;
    --urbangreen-glow: rgba(76, 175, 80, 0.3);
}

.card {
    border-radius: 1.5rem;
}

.urbangreen-icon-container {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.form-control-urbangreen, .form-select-urbangreen {
    border-radius: 0.75rem;
    border: 2px solid #e8f5e9;
    transition: all 0.3s;
    padding: 0.75rem 1rem;
}

.form-control-urbangreen:focus, .form-select-urbangreen:focus {
    border-color: #2e7d32;
    box-shadow: 0 0 0 0.3rem rgba(46, 125, 50, 0.2);
    background-color: #f8f9fa;
}

.image-upload-container-urbangreen {
    border: 3px dashed #e8f5e9;
    border-radius: 1.5rem;
    padding: 2.5rem;
    transition: all 0.3s;
    background: linear-gradient(135deg, #f8f9fa 0%, #e8f5e9 100%);
}

.image-upload-container-urbangreen:hover {
    border-color: #2e7d32;
    background: linear-gradient(135deg, #f1f8e9 0%, #e8f5e9 100%);
    transform: translateY(-2px);
}

.rounded-urbangreen {
    border-radius: 1rem !important;
}

/* ✅ Styles améliorés pour les boutons Upload et Generate AI */
.btn-upload-photo, .btn-generate-ai {
    position: relative;
    padding: 1rem 2rem;
    border: none;
    border-radius: 1rem;
    font-weight: 600;
    transition: all 0.4s ease;
    overflow: hidden;
    min-width: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-upload-photo {
    background: linear-gradient(135deg, #6c757d, #495057);
    color: white;
    box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
}

.btn-generate-ai {
    background: linear-gradient(135deg, #059002ff, #049947ff);
    color: white;
    box-shadow: 0 4px 15px rgba(73, 255, 53, 0.3);
}

.btn-upload-photo:hover, .btn-generate-ai:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
}

.btn-upload-photo:hover {
    background: linear-gradient(135deg, #5a6268, #3d4348);
    box-shadow: 0 8px 25px rgba(108, 117, 125, 0.4);
}

.btn-generate-ai:hover {
    background: linear-gradient(135deg, #00b834ff, #316a30ff);
    box-shadow: 0 8px 25px rgba(18, 143, 24, 0.4);
}

.btn-content {
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.btn-hover-effect {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0);
    opacity: 0;
    transition: all 0.3s ease;
    font-size: 1.5rem;
}

.btn-upload-photo:hover .btn-content,
.btn-generate-ai:hover .btn-content {
    transform: translateY(-100%);
    opacity: 0;
}

.btn-upload-photo:hover .btn-hover-effect,
.btn-generate-ai:hover .btn-hover-effect {
    transform: translate(-50%, -50%) scale(1);
    opacity: 1;
}

/* ✅ Styles pour les alertes personnalisées */
.custom-alert {
    border-radius: 1rem;
    border: none;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    margin-bottom: 1.5rem;
}

.alert-success {
    background: linear-gradient(135deg, #d4edda, #c3e6cb);
    border-left: 4px solid #28a745;
    color: #155724;
}

.alert-warning {
    background: linear-gradient(135deg, #fff3cd, #ffeaa7);
    border-left: 4px solid #ffc107;
    color: #856404;
}

.alert-danger {
    background: linear-gradient(135deg, #f8d7da, #f5c6cb);
    border-left: 4px solid #dc3545;
    color: #721c24;
}

/* ✅ Styles pour le header */
.card-header {
    border-radius: 1.5rem 1.5rem 0 0 !important;
}

/* ✅ Styles pour les labels et icônes */
.text-success {
    color: #2e7d32 !important;
}

.text-success i {
    color: #2e7d32 !important;
}

/* ✅ Responsive */
@media (max-width: 768px) {
    .btn-upload-photo, .btn-generate-ai {
        min-width: 100%;
        margin-bottom: 1rem;
    }
    
    .d-flex.flex-column.flex-md-row {
        flex-direction: column !important;
    }
}
</style>
@endsection