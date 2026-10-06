@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-edit"></i>
            Modify the financing
        </h1>
        <a href="{{ route('financements.index') }}" class="btn btn-outline">
            <i class="fas fa-arrow-left"></i> Return to list
        </a>
    </div>

    <div class="form-container">
        <form action="{{ route('financements.update', $financement->idFinancement) }}" method="POST" class="modern-form">
            @csrf
            @method('PUT')
            
            <div class="form-grid">
                <div class="form-group">
                    <label for="montant" class="form-label">
                        <i class="fas fa-euro-sign"></i>
                        Amount
                    </label>
                    <div class="input-with-icon">
                        <input type="number" step="0.01" name="montant" id="montant" 
                               class="form-control" required placeholder="0.00"
                               value="{{ old('montant', $financement->montant) }}">
                        <span class="input-suffix">€</span>
                    </div>
                    @error('montant')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="dateDebut" class="form-label">
                        <i class="fas fa-calendar-alt"></i>
                       Start Date
                    </label>
                    <input type="date" name="dateDebut" id="dateDebut" 
                           class="form-control" required
                           value="{{ old('dateDebut', $financement->dateDebut) }}">
                    @error('dateDebut')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="dateFin" class="form-label">
                        <i class="fas fa-calendar-check"></i>
                        End Date
                    </label>
                    <input type="date" name="dateFin" id="dateFin" 
                           class="form-control" required
                           value="{{ old('dateFin', $financement->dateFin) }}">
                    @error('dateFin')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="idPartenaire" class="form-label">
                        <i class="fas fa-handshake"></i>
                        Partner
                    </label>
                    <select name="idPartenaire" id="idPartenaire" class="form-control select-custom" required>
                        <option value="">-- Select a partner  --</option>
                        @foreach($partenaires as $partenaire)
                            <option value="{{ $partenaire->idPartenaire }}" 
                                    {{ old('idPartenaire', $financement->idPartenaire) == $partenaire->idPartenaire ? 'selected' : '' }}>
                                {{ $partenaire->nom }}
                                @if($partenaire->type)
                                    <span class="option-badge">{{ $partenaire->type }}</span>
                                @endif
                            </option>
                        @endforeach
                    </select>
                    @error('idPartenaire')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="idProjet" class="form-label">
                        <i class="fas fa-project-diagram"></i>
                        Project
                    </label>
                    <select name="idProjet" id="idProjet" class="form-control select-custom" required>
                        <option value="">-- Select a project --</option>
                        @foreach($projets as $projet)
                            <option value="{{ $projet->idProjet }}" 
                                    {{ old('idProjet', $financement->idProjet) == $projet->idProjet ? 'selected' : '' }}>
                                {{ $projet->nom }}
                                @if($projet->statut)
                                    <span class="option-badge {{ $projet->statut == 'actif' ? 'badge-success' : 'badge-warning' }}">
                                        {{ $projet->statut }}
                                    </span>
                                @endif
                            </option>
                        @endforeach
                    </select>
                    @error('idProjet')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save"></i>
                    Modify the financing
                </button>
                <a href="{{ route('financements.index') }}" class="btn btn-outline">
                    <i class="fas fa-times"></i>
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
<style>
    /* ===== VARIABLES CSS COHÉRENTES ===== */
    :root {
        --primary: #2e7d32;
        --primary-light: #4caf50;
        --primary-dark: #3ad456ff;
        --secondary: #3ad456ff;
        --success: #4cc9f0;
        --success-light: #e8f8ff;
        --danger: #3ad456ff;
        --danger-light: #ffe8f1;
        --warning: #f8961e;
        --light: #f8f9fa;
        --dark: #212529;
        --gray-100: #f8f9fa;
        --gray-200: #e9ecef;
        --gray-300: #dee2e6;
        --gray-400: #ced4da;
        --gray-500: #adb5bd;
        --gray-600: #6c757d;
        --gray-700: #495057;
        --gray-800: #343a40;
        --gray-900: #212529;
        
        --border-radius: 12px;
        --border-radius-sm: 8px;
        --border-radius-lg: 16px;
        
        --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.06);
        --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.08);
        --shadow-lg: 0 8px 24px rgba(0, 0, 0, 0.12);
        --shadow-primary: 0 6px 20px rgba(46, 125, 50, 0.15);
        
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        --transition-fast: all 0.15s ease;
    }

    /* ===== STYLES GÉNÉRAUX ===== */
    .card {
        background: white;
        border-radius: var(--border-radius-lg);
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--gray-200);
        padding: 2rem;
        margin: 0;
        transition: var(--transition);
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid var(--gray-200);
    }

    .page-header h1 {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--gray-900);
        margin: 0;
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    /* ===== BOUTONS COHÉRENTS ===== */
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        color: white;
        border: none;
        border-radius: var(--border-radius);
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        text-decoration: none;
        font-size: 0.875rem;
        position: relative;
        overflow: hidden;
    }

    .btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: var(--transition);
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-primary);
    }

    .btn:hover::before {
        left: 100%;
    }

    .btn-outline {
        background: transparent;
        border: 2px solid var(--primary);
        color: var(--primary);
        font-weight: 500;
    }

    .btn-outline:hover {
        background: var(--primary);
        color: white;
        transform: translateY(-2px);
    }

    .btn-lg {
        padding: 1rem 2rem;
        font-size: 1rem;
    }

    /* ===== CONTAINER DU FORMULAIRE ===== */
    .form-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .modern-form {
        background: white;
        padding: 2.5rem;
        border-radius: var(--border-radius-lg);
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--gray-200);
        transition: var(--transition);
    }

    .modern-form:hover {
        box-shadow: var(--shadow-md);
    }

    /* ===== GRILLE DE FORMULAIRE ===== */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    /* ===== GROUPES DE FORMULAIRES ===== */
    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-weight: 600;
        color: var(--gray-800);
        margin-bottom: 0.75rem;
        font-size: 0.95rem;
    }

    .form-label i {
        color: var(--primary);
        width: 16px;
        font-size: 0.9rem;
    }

    /* ===== CHAMPS DE FORMULAIRE ===== */
    .form-control {
        width: 100%;
        padding: 1rem 1.25rem;
        border: 2px solid var(--gray-200);
        border-radius: var(--border-radius);
        font-size: 1rem;
        transition: var(--transition);
        background: var(--gray-100);
        font-family: inherit;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        background: white;
        box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
        transform: translateY(-2px);
    }

    /* ===== CHAMPS AVEC ICÔNES ===== */
    .input-with-icon {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-with-icon .form-control {
        padding-right: 3rem;
    }

    .input-suffix {
        position: absolute;
        right: 1.25rem;
        color: var(--gray-600);
        font-weight: 600;
        font-size: 0.9rem;
    }

    /* ===== SELECTEURS PERSONNALISÉS ===== */
    .select-custom {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%236c757d'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 16px;
        appearance: none;
        cursor: pointer;
        padding-right: 3rem;
    }

    .select-custom option {
        padding: 0.75rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid var(--gray-200);
    }

    .option-badge {
        font-size: 0.7rem;
        padding: 0.25rem 0.75rem;
        border-radius: 12px;
        background: var(--gray-200);
        color: var(--gray-700);
        margin-left: 0.5rem;
        font-weight: 500;
    }

    .badge-success {
        background: rgba(76, 201, 240, 0.15);
        color: #0c8599;
    }

    .badge-warning {
        background: rgba(248, 150, 30, 0.15);
        color: #e67700;
    }

    /* ===== ZONE DE TEXTE ===== */
    textarea.form-control {
        resize: vertical;
        min-height: 120px;
        line-height: 1.5;
    }

    /* ===== ACTIONS DU FORMULAIRE ===== */
    .form-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        align-items: center;
        margin-top: 2.5rem;
        padding-top: 2rem;
        border-top: 1px solid var(--gray-200);
    }

    /* ===== MESSAGES D'ERREUR ===== */
    .error-message {
        color: #e63946;
        font-size: 0.85rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 500;
    }

    .error-message::before {
        content: '⚠';
        font-size: 0.8rem;
    }

    /* ===== ÉTATS DE VALIDATION ===== */
    .form-control.valid {
        border-color: #4cc9f0;
        background: rgba(76, 201, 240, 0.05);
    }

    .form-control.invalid {
        border-color: #e63946;
        background: rgba(230, 57, 70, 0.05);
    }

    /* ===== STYLES SPÉCIFIQUES POUR LES DATES ===== */
    input[type="date"] {
        position: relative;
    }

    input[type="date"]::-webkit-calendar-picker-indicator {
        background: transparent;
        bottom: 0;
        color: transparent;
        cursor: pointer;
        height: auto;
        left: 0;
        position: absolute;
        right: 0;
        top: 0;
        width: auto;
    }

    /* ===== ANIMATIONS ===== */
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .modern-form {
        animation: slideInUp 0.5s ease forwards;
    }

    .form-group {
        animation: slideInUp 0.6s ease forwards;
    }

    .form-group:nth-child(odd) {
        animation-delay: 0.1s;
    }

    .form-group:nth-child(even) {
        animation-delay: 0.2s;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .card {
            padding: 1.5rem;
        }
        
        .page-header {
            flex-direction: column;
            align-items: flex-start;
            text-align: left;
        }
        
        .form-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .modern-form {
            padding: 1.5rem;
        }
        
        .form-actions {
            flex-direction: column;
        }
        
        .form-actions .btn {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .card {
            padding: 1rem;
            border-radius: var(--border-radius);
        }
        
        .page-header h1 {
            font-size: 1.5rem;
        }
        
        .modern-form {
            padding: 1rem;
        }
        
        .form-control {
            padding: 0.875rem 1rem;
        }
    }

    /* ===== EFFETS DE FOCUS AMÉLIORÉS ===== */
    .form-control:focus {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(46, 125, 50, 0.15);
    }

    /* ===== STYLE POUR LES GROUPES D'OPTIONS ===== */
    .select-custom optgroup {
        font-weight: 600;
        color: var(--primary);
        padding: 0.5rem;
        background: var(--gray-100);
    }

    .select-custom option {
        padding: 0.75rem 1rem;
        margin: 0.125rem 0;
        border-radius: 4px;
    }

    .select-custom option:hover {
        background: var(--primary);
        color: white;
    }

    /* ===== INDICATEUR DE CHAMP REQUIS ===== */
    .form-label::after {
        content: '*';
        color: #e63946;
        margin-left: 2px;
    }

    .form-label:has(+ .form-control:not([required]))::after {
        content: '';
    }
</style>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Validation en temps réel
        const form = document.querySelector('.modern-form');
        const inputs = form.querySelectorAll('.form-control');
        
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(this);
            });
            
            input.addEventListener('input', function() {
                if (this.classList.contains('invalid')) {
                    validateField(this);
                }
            });
        });

        function validateField(field) {
            const errorElement = field.parentNode.querySelector('.error-message') || 
                               field.nextElementSibling;
            
            if (field.validity.valid) {
                field.classList.remove('invalid');
                field.classList.add('valid');
                if (errorElement) {
                    errorElement.style.display = 'none';
                }
            } else {
                field.classList.remove('valid');
                field.classList.add('invalid');
            }
        }

        // Calcul automatique de la durée si les deux dates sont renseignées
        const dateDebut = document.getElementById('dateDebut');
        const dateFin = document.getElementById('dateFin');
        
        function calculateDuration() {
            if (dateDebut.value && dateFin.value) {
                const start = new Date(dateDebut.value);
                const end = new Date(dateFin.value);
                const diffTime = Math.abs(end - start);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                
                // Vous pourriez afficher la durée quelque part
                console.log(`Durée: ${diffDays} jours`);
            }
        }
        
        dateDebut.addEventListener('change', calculateDuration);
        dateFin.addEventListener('change', calculateDuration);

        // Validation initiale
        inputs.forEach(input => {
            validateField(input);
        });
    });
</script>
@endsection