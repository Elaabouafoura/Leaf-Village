@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-handshake"></i>
            Add Partner
        </h1>
        <a href="{{ route('partenaires.index') }}" class="btn btn-outline">
            <i class="fas fa-arrow-left"></i> Return to list
        </a>
    </div>

    <div class="form-container">
        <form action="{{ route('partenaires.store') }}" method="POST" class="modern-form">
            @csrf
            
            <div class="form-grid">
                <div class="form-group">
                    <label for="nom" class="form-label">
                        <i class="fas fa-building"></i>
                       Partner Name
                    </label>
                    <input type="text" name="nom" id="nom" 
                           class="form-control" required 
                           placeholder="Entrez le nom du partenaire"
                           value="{{ old('nom') }}">
                    @error('nom')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="type" class="form-label">
                        <i class="fas fa-tag"></i>
                        Type
                    </label>
                    <select name="type" id="type" class="form-control select-custom" required>
                        <option value="">-- Sélectionner un type --</option>
                        <option value="Entreprise" {{ old('type') == 'Entreprise' ? 'selected' : '' }}>Entreprise</option>
                        <option value="Institution" {{ old('type') == 'Institution' ? 'selected' : '' }}>Institution</option>
                        <option value="Association" {{ old('type') == 'Association' ? 'selected' : '' }}>Association</option>
                        <option value="Organisme public" {{ old('type') == 'Organisme public' ? 'selected' : '' }}>publicOrganism</option>
                         <option value="Banques" {{ old('type') == 'Banques' ? 'selected' : '' }}>Banques</option>
                        <option value="Autre" {{ old('type') == 'Autre' ? 'selected' : '' }}>Autre</option>
                    </select>
                    @error('type')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="contact" class="form-label">
                        <i class="fas fa-user"></i>
                        Contact Principal
                    </label>
                    <input type="text" name="contact" id="contact" 
                           class="form-control" required 
                           placeholder="Nom du contact principal"
                           value="{{ old('contact') }}">
                    @error('contact')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope"></i>
                        Email
                    </label>
                    <input type="email" name="email" id="email" 
                           class="form-control" 
                           placeholder="email@exemple.com"
                           value="{{ old('email') }}">
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-grid">
                

               
            </div>

          

            <div class="form-actions">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save"></i>
                    Save Partner
                </button>
                <a href="{{ route('partenaires.index') }}" class="btn btn-outline">
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
            const errorElement = field.parentNode.querySelector('.error-message');
            
            if (field.validity.valid) {
                field.classList.remove('invalid');
                field.classList.add('valid');
                if (errorElement) {
                    errorElement.style.display = 'none';
                }
            } else {
                field.classList.remove('valid');
                field.classList.add('invalid');
                if (errorElement) {
                    errorElement.style.display = 'flex';
                }
            }
        }

        // Masquer les messages d'erreur au chargement si le champ est valide
        inputs.forEach(input => {
            if (input.validity.valid) {
                const errorElement = input.parentNode.querySelector('.error-message');
                if (errorElement) {
                    errorElement.style.display = 'none';
                }
            }
        });

        // Auto-format du téléphone
        const telephoneInput = document.getElementById('telephone');
        if (telephoneInput) {
            telephoneInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 0) {
                    if (value.length <= 2) {
                        value = '+33 ' + value;
                    } else if (value.length <= 4) {
                        value = '+33 ' + value.substring(2);
                    } else if (value.length <= 6) {
                        value = '+33 ' + value.substring(2, 4) + ' ' + value.substring(4);
                    } else if (value.length <= 8) {
                        value = '+33 ' + value.substring(2, 4) + ' ' + value.substring(4, 6) + ' ' + value.substring(6);
                    } else {
                        value = '+33 ' + value.substring(2, 4) + ' ' + value.substring(4, 6) + ' ' + value.substring(6, 8) + ' ' + value.substring(8, 10);
                    }
                }
                e.target.value = value;
            });
        }
    });
</script>
@endsection