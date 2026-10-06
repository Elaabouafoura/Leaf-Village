@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-urbangreen border-0">
                <div class="card-header bg-gradient-urbangreen text-white py-4">
                    <div class="d-flex align-items-center">
                        <div class="urbangreen-icon-container me-3">
                            <i class="fas fa-edit fa-2x"></i>
                        </div>
                        <div>
                            <h4 class="mb-1">Edit event</h4>
                            <p class="mb-0 opacity-8">Let's renew our commitment to the planet</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('events.update', $event->idEvenement) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Photo -->
                            <div class="col-12 mb-4">
                                <label class="form-label fw-bold text-urbangreen-dark">
                                    <i class="fas fa-camera me-2 text-urbangreen"></i>
                                   Event photo
                                </label>
                                <div class="text-center">
                                    <!-- Conteneur de prévisualisation unique -->
                                    <div id="photoPreviewContainer">
                                        @if($event->photo)
                                            <div class="position-relative">
                                                <img id="photoPreview" src="{{ asset('storage/' . $event->photo) }}" 
                                                     alt="Photo actuelle" 
                                                     class="rounded-urbangreen shadow-urbangreen mb-3"
                                                     style="height: 220px; object-fit: cover; width: 100%;">
                                                <div class="position-absolute top-0 end-0 m-2">
                                                    <span class="badge badge-urbangreen upcoming">
                                                        <i class="fas fa-image me-1"></i>Current
                                                    </span>
                                                </div>
                                            </div>
                                        @else
                                            <div id="photoPreview" class="bg-gradient-urbangreen-light rounded-urbangreen shadow-sm mb-3 d-flex align-items-center justify-content-center"
                                                 style="height: 220px;">
                                                <div class="text-center">
                                                    <i class="fas fa-image fa-4x text-urbangreen opacity-50 mb-3"></i>
                                                    <p class="text-urbangreen-dark mb-0 fw-semibold">No photo</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Input file caché -->
                                    <input type="file" name="photo" id="photo" 
                                           class="form-control d-none" 
                                           accept="image/*">
                                    
                                    <!-- Boutons d'action -->
                                    <div class="d-flex gap-2 justify-content-center flex-wrap">
                                        <button type="button" class="btn btn-outline-urbangreen mb-2" 
                                                onclick="document.getElementById('photo').click()">
                                            <i class="fas fa-camera me-2"></i>
                                            {{ $event->photo ? 'Change photo' : 'Ajouter une photo' }}
                                        </button>
                                        
                                        <!-- Bouton pour supprimer la photo si elle existe -->
                                        @if($event->photo)
                                            <button type="button" class="btn btn-outline-urbangreen-danger mb-2" 
                                                    onclick="showDeleteConfirmation()">
                                                <i class="fas fa-trash me-2"></i>delete
                                            </button>
                                            <input type="hidden" name="remove_photo" id="remove_photo" value="0">
                                        @endif
                                    </div>
<button type="button" class="btn btn-generate-ai" id="generateAI">
                                            <div class="btn-content">
                                                <i class="fas fa-magic me-2"></i>
                                                <span>Generate with AI</span>
                                            </div>
                                            <div class="btn-hover-effect">
                                                <i class="fas fa-robot"></i>
                                            </div>
                                        </button>
                                    <small class="text-muted d-block mt-2">
                                        Format recommandé : JPG, PNG (max 2MB)
                                    </small>
                                </div>
                            </div>

                            <!-- Nom -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-urbangreen-dark">
                                    <i class="fas fa-tag me-2 text-urbangreen"></i>
                                    Event Name *
                                </label>
                                <input type="text" name="nom" class="form-control form-control-urbangreen @error('nom') is-invalid @enderror" 
                                       value="{{ old('nom', $event->nom) }}" required>
                                @error('nom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Date -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-urbangreen-dark">
                                    <i class="fas fa-calendar me-2 text-urbangreen"></i>
                                    Date *
                                </label>
                                <input type="date" name="date" class="form-control form-control-urbangreen @error('date') is-invalid @enderror" 
                                       value="{{ old('date', $event->date) }}" required>
                                @error('date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Lieu -->
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold text-urbangreen-dark">
                                    <i class="fas fa-map-marker-alt me-2 text-urbangreen"></i>
                                    Location *
                                </label>
                                <input type="text" name="lieu" class="form-control form-control-urbangreen @error('lieu') is-invalid @enderror" 
                                       value="{{ old('lieu', $event->lieu) }}" required>
                                @error('lieu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Projet -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-urbangreen-dark">
                                    <i class="fas fa-project-diagram me-2 text-urbangreen"></i>
                                    Associated project *
                                </label>
                                <select name="idProjet" class="form-select form-select-urbangreen @error('idProjet') is-invalid @enderror" required>
                                    @foreach($projets as $projet)
                                        <option value="{{ $projet->idProjet }}" 
                                                {{ $event->idProjet == $projet->idProjet ? 'selected' : '' }}>
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
                                <label class="form-label fw-bold text-urbangreen-dark">
                                    <i class="fas fa-file-alt me-2 text-urbangreen"></i>
                                    Description
                                </label>
                                <textarea name="description" class="form-control form-control-urbangreen @error('description') is-invalid @enderror" 
                                          rows="5" placeholder="Décrivez l'événement, ses objectifs, l'impact environnemental...">{{ old('description', $event->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="d-flex gap-3 justify-content-end pt-4 border-top border-urbangreen-light">
                            <a href="{{ route('events.index') }}" class="btn btn-outline-secondary btn-lg">
                                <i class="fas fa-arrow-left me-2"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-urbangreen btn-lg">
                                <i class="fas fa-save me-2"></i>Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="deletePhotoModal" tabindex="-1" aria-labelledby="deletePhotoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-urbangreen text-white">
                <h5 class="modal-title" id="deletePhotoModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Confirm deletion
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="mb-3">
                    <i class="fas fa-trash-alt fa-3x text-urbangreen"></i>
                </div>
                <h5 class="fw-bold text-dark mb-3">Delete this photo ?</h5>
                <p class="text-muted">
                    This action is irreversible. The photo will be permanently deleted from the event
                </p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancel
                </button>
                <button type="button" class="btn btn-urbangreen-danger" onclick="confirmDeletePhoto()">
                    <i class="fas fa-trash me-2"></i>Yes, delete
                </button>
            </div>
        </div>
    </div>
</div>
<script>
const photoPreviewContainer = document.getElementById('photoPreviewContainer');
const removePhotoInput = document.getElementById('remove_photo');
const fileInput = document.getElementById('photo');
const deletePhotoModal = new bootstrap.Modal(document.getElementById('deletePhotoModal'));

// Prévisualisation de la nouvelle photo
fileInput.addEventListener('change', function(e) {
    const file = e.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const newContent = `
                <div class="position-relative">
                    <img id="photoPreview" src="${e.target.result}" 
                         alt="Nouvelle photo" 
                         class="rounded-urbangreen shadow-urbangreen mb-3"
                         style="height: 220px; object-fit: cover; width: 100%;">
                    <div class="position-absolute top-0 end-0 m-2">
                        <span class="badge badge-urbangreen upcoming" style="background: #ff6b35 !important;">
                            <i class="fas fa-star me-1"></i>Nouvelle
                        </span>
                    </div>
                </div>
            `;
            photoPreviewContainer.innerHTML = newContent;
            if (removePhotoInput) removePhotoInput.value = '0';
        }
        reader.readAsDataURL(file);
    }
});

// Suppression de la photo
function showDeleteConfirmation() { deletePhotoModal.show(); }

function confirmDeletePhoto() {
    photoPreviewContainer.innerHTML = `
        <div id="photoPreview" class="bg-gradient-urbangreen-light rounded-urbangreen shadow-sm mb-3 d-flex align-items-center justify-content-center"
             style="height: 220px;">
            <div class="text-center">
                <i class="fas fa-image fa-4x text-urbangreen opacity-50 mb-3"></i>
                <p class="text-urbangreen-dark mb-0 fw-semibold">Aucune photo</p>
            </div>
        </div>
    `;
    if (removePhotoInput) removePhotoInput.value = '1';
    fileInput.value = '';
    deletePhotoModal.hide();
    showTempMessage('Photo supprimée avec succès', 'success');
}

// Message temporaire
function showTempMessage(message, type) {
    const alertClass = type === 'success' ? 'alert-urbangreen' : 'alert-danger';
    const iconClass = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
    document.querySelectorAll('.temp-alert').forEach(a => a.remove());
    const alertDiv = document.createElement('div');
    alertDiv.className = `temp-alert alert ${alertClass} alert-dismissible fade show position-fixed`;
    alertDiv.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    alertDiv.innerHTML = `
        <i class="fas ${iconClass} me-2"></i>
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    document.body.appendChild(alertDiv);
    setTimeout(() => {
        if (alertDiv.parentNode) new bootstrap.Alert(alertDiv).close();
    }, 4000);
}

// ✅ Correction ici : on utilise photoPreview, pas imagePreview
document.getElementById('generateAI').addEventListener('click', async function() {
    const nom = document.querySelector('input[name="nom"]').value.trim();
    const description = document.querySelector('textarea[name="description"]').value.trim();

    if (!nom || !description) {
        const alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-warning alert-dismissible fade show custom-alert';
        alertDiv.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-triangle me-3"></i>
                <div>
                    <strong>Champs requis manquants</strong><br>
                    Veuillez remplir le nom et la description pour générer une image avec l'IA.
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        const cardBody = document.querySelector('.card-body');
        cardBody.insertBefore(alertDiv, cardBody.firstChild);
        setTimeout(() => alertDiv.remove(), 5000);
        return;
    }

    const preview = document.getElementById('photoPreview');
    const generateBtn = document.getElementById('generateAI');
    const originalContent = generateBtn.innerHTML;
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
            preview.src = "data:image/png;base64," + data.image_base64;
            showTempMessage('Image générée avec succès !', 'success');
        } else {
            showTempMessage('Erreur : impossible de générer l\'image.', 'error');
        }
    } catch (error) {
        console.error(error);
        showTempMessage('Erreur de connexion au serveur.', 'error');
    } finally {
        generateBtn.innerHTML = originalContent;
        generateBtn.disabled = false;
    }
});
</script>


<style>
:root {
    --urbangreen-primary: #2dce89;
    --urbangreen-dark: #1e7a5d;
    --urbangreen-light: #e8f5e8;
    --urbangreen-gradient: linear-gradient(135deg, #2dce89 0%, #1e7a5d 100%);
    --urbangreen-gradient-light: linear-gradient(135deg, #e8f5e8 0%, #d4edda 100%);
}

/* Cartes */
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

/* Formulaires */
.form-control-urbangreen, .form-select-urbangreen {
    border-radius: 0.75rem;
    border: 2px solid #e8f5e8;
    transition: all 0.3s;
    padding: 0.75rem 1rem;
}

.form-control-urbangreen:focus, .form-select-urbangreen:focus {
    border-color: var(--urbangreen-primary);
    box-shadow: 0 0 0 0.3rem rgba(45, 206, 137, 0.2);
    background-color: #f8fff8;
}

/* Badges */
.badge-urbangreen {
    border-radius: 2rem;
    padding: 0.5rem 1rem;
    font-weight: 600;
    font-size: 0.75rem;
}

.badge-urbangreen.upcoming {
    background: rgba(45, 206, 137, 0.95);
    color: white;
}

/* Boutons */
.btn-urbangreen {
    background: var(--urbangreen-gradient);
    border: none;
    color: white;
    font-weight: 600;
    border-radius: 0.75rem;
    transition: all 0.3s ease;
}
* ✅ Styles améliorés pour les boutons Upload et Generate AI */
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
.btn-generate-ai {
    background: linear-gradient(135deg, #059002ff, #049947ff);
    color: white;
    box-shadow: 0 4px 15px rgba(73, 255, 53, 0.3);
}.btn-upload-photo:hover, .btn-generate-ai:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
}.btn-generate-ai:hover {
    background: linear-gradient(135deg, #00b834ff, #316a30ff);
    box-shadow: 0 8px 25px rgba(18, 143, 24, 0.4);
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

.btn-urbangreen:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.5rem 1.5rem rgba(45, 206, 137, 0.4);
    color: white;
}

.btn-outline-urbangreen {
    border: 2px solid var(--urbangreen-primary);
    color: var(--urbangreen-primary);
    border-radius: 0.75rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-outline-urbangreen:hover {
    background: var(--urbangreen-primary);
    color: white;
    transform: translateY(-2px);
}

.btn-urbangreen-danger {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    border: none;
    color: white;
    border-radius: 0.75rem;
    font-weight: 600;
}

.btn-outline-urbangreen-danger {
    border: 2px solid #dc3545;
    color: #dc3545;
    border-radius: 0.75rem;
    font-weight: 600;
}

.btn-outline-urbangreen-danger:hover {
    background: #dc3545;
    color: white;
    transform: translateY(-2px);
}

/* Arrondis */
.rounded-urbangreen {
    border-radius: 1rem !important;
}

.border-urbangreen-light {
    border-color: #e8f5e8 !important;
}

/* Dégradés */
.bg-gradient-urbangreen {
    background: var(--urbangreen-gradient) !important;
}

.bg-gradient-urbangreen-light {
    background: var(--urbangreen-gradient-light) !important;
}

/* Ombres */
.shadow-urbangreen {
    box-shadow: 0 1rem 3rem rgba(45, 206, 137, 0.25) !important;
}

/* Textes */
.text-urbangreen { color: var(--urbangreen-primary) !important; }
.text-urbangreen-dark { color: var(--urbangreen-dark) !important; }
.text-urbangreen-light { color: #e8f5e8 !important; }

/* Alertes */
.alert-urbangreen {
    background: var(--urbangreen-gradient-light);
    border: 2px solid var(--urbangreen-primary);
    color: var(--urbangreen-dark);
    border-radius: 1rem;
    border-left: 6px solid var(--urbangreen-primary);
}

/* Animation de pulse pour les badges */
@keyframes pulse-urbangreen {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.badge-urbangreen.upcoming {
    animation: pulse-urbangreen 2s infinite;
}

/* Responsive */
@media (max-width: 768px) {
    .d-flex.gap-2 {
        flex-direction: column;
        align-items: center;
    }
    
    .btn {
        width: 100%;
        max-width: 250px;
    }
}
</style>
@endsection