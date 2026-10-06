@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">

    <!-- Notifications -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-4" role="alert" style="background: linear-gradient(135deg, #dcedc8, #c5e1a5); border: none; border-radius: 12px; color: #33691e;">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-3 fs-5"></i>
                <div class="flex-grow-1">{{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-5 mt-3">
        <div>
            <h1 class="h3 mb-2 fw-bold" style="color: #4caf50;">
Supplier Management</h1>
            <p class="text-muted mb-0">
Effectively manage your green space suppliers</p>
        </div>
        <button class="btn btn-lg shadow-sm" style="background: linear-gradient(135deg, #4caf50, #66bb6a); color: #fff; border: none; border-radius: 12px;" data-bs-toggle="modal" data-bs-target="#addFournisseurModal">
            <i class="fas fa-plus-circle me-2"></i>Add Supplier
        </button>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-5">
        <div class="col-xl-4 col-md-6">
            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9); border-radius: 16px;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title text-muted mb-2">Total Suppliers</h6>
                            <h3 class="fw-bold mb-0" style="color: #2e7d32;">{{ $fournisseurs->total() }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle" style="background: rgba(76, 175, 80, 0.1);">
                                <i class="fas fa-truck fs-3" style="color: #4caf50;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #e3f2fd, #bbdefb); border-radius: 16px;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title text-muted mb-2">with Adress</h6>
                            <h3 class="fw-bold mb-0" style="color: #1976d2;">{{ $fournisseurs->where('adresse', '!=', null)->count() }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle" style="background: rgba(25, 118, 210, 0.1);">
                                <i class="fas fa-map-marker-alt fs-3" style="color: #1976d2;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #fff3e0, #ffcc80); border-radius: 16px;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title text-muted mb-2">with Contact</h6>
                            <h3 class="fw-bold mb-0" style="color: #f57c00;">{{ $fournisseurs->where('contact', '!=', null)->count() }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle" style="background: rgba(245, 124, 0, 0.1);">
                                <i class="fas fa-phone fs-3" style="color: #f57c00;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search & Filter Section -->
    <div class="card border-0 shadow-sm mb-5" style="border-radius: 16px; background: #f8fdf9;">
        <div class="card-body p-4">
            <div class="row g-3 align-items-center">
                <div class="col-md-8">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-transparent border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" id="searchInput" class="form-control border-start-0 ps-0" placeholder="Nom, adresse, contact..." style="border-radius: 12px; font-size: 0.95rem;">
                    </div>
                </div>
                <div class="col-md-4 text-md-end">
                    <div class="d-flex gap-2 justify-content-md-end">
                        <button id="resetFilters" class="btn btn-outline-secondary px-4" style="border-radius: 12px;">
                            <i class="fas fa-undo me-2"></i>Reset
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau des fournisseurs -->
    <div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
        <div class="card-header py-4" style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9); border-bottom: none;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1 fw-bold" style="color: #2e7d32;">
                        <i class="fas fa-truck me-2"></i>
                        List of Suppliers
                    </h5>
                    <p class="text-muted mb-0">Display of {{ $fournisseurs->count() }}  {{ $fournisseurs->total() }} Suppliers</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge rounded-pill px-3 py-2" style="background: rgba(76, 175, 80, 0.1); color: #2e7d32;">
                        <i class="fas fa-chart-bar me-1"></i>
                        {{ $fournisseurs->total() }} Total
                    </span>
                </div>
            </div>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="fournisseurTable">
                    <thead style="background: #f1f8e9;">
                        <tr>
                            <th class="ps-4 py-3 fw-semibold text-uppercase small text-muted">Name</th>
                            <th class="py-3 fw-semibold text-uppercase small text-muted">Adress</th>
                            <th class="py-3 fw-semibold text-uppercase small text-muted">Contact</th>
                            <th class="pe-4 py-3 fw-semibold text-uppercase small text-muted text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($fournisseurs as $fournisseur)
                            <tr class="border-bottom">
                                <td class="ps-4 py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="p-3 rounded" style="background: rgba(33, 150, 243, 0.1);">
                                                <i class="fas fa-truck text-primary fs-5"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="fw-bold mb-1" style="color: #2e7d32;">{{ $fournisseur->nom }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-map-marker-alt text-muted me-2"></i>
                                        <span>{{ $fournisseur->adresse }}</span>
                                    </div>
                                </td>
                                <td class="py-4">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-phone text-muted me-2"></i>
                                        <span>{{ $fournisseur->contact }}</span>
                                    </div>
                                </td>
                                <td class="pe-4 py-4 text-end">
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-sm btn-light rounded-start-pill px-3"
                                                onclick="openAIComposeModal({{ $fournisseur->idFournisseur }})"
                                                title="IA Email">
                                            <i class="fas fa-robot text-success"></i>
                                        </button>
                                        <button class="btn btn-sm btn-light rounded-0 px-3" 
                                                data-bs-toggle="modal"
                                                data-bs-target="#editFournisseurModal{{ $fournisseur->idFournisseur }}"
                                                title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('fournisseurs.destroy', $fournisseur->idFournisseur) }}" 
                                              method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-light rounded-end-pill px-3 text-danger" 
                                                    onclick="return confirm('Voulez-vous vraiment supprimer ce fournisseur ?')"
                                                    title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal de modification -->
                            <div class="modal fade" id="editFournisseurModal{{ $fournisseur->idFournisseur }}" tabindex="-1">
                                <div class="modal-dialog modal-md modal-dialog-centered">
                                    <form id="editFournisseurForm{{ $fournisseur->idFournisseur }}" method="POST" action="{{ route('fournisseurs.update', $fournisseur->idFournisseur) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content border-0" style="border-radius: 16px; overflow: hidden;">
                                            <div class="modal-header" style="background: linear-gradient(135deg, #e9ffe0ff, #b9ffb3ff); border-bottom: none; padding: 1.5rem 1.5rem 1rem;">
                                                <div class="d-flex align-items-center w-100">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="p-2 rounded-circle" style="background: rgba(255,255,255,0.3);">
                                                            <i class="fas fa-edit text-warning fs-4"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h5 class="modal-title fw-bold mb-0 fs-6" style="color: #2e7d32;">Edit supplier</h5>
                                                    </div>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="transform: scale(0.8);"></button>
                                                </div>
                                            </div>
                                            <div class="modal-body p-3">
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <label class="form-label fw-semibold small">Name of supplier <span class="text-danger">*</span></label>
                                                        <input type="text" name="nom" value="{{ $fournisseur->nom }}" class="form-control form-control-sm" style="border-radius: 10px; padding: 10px 12px; font-size: 0.9rem;">
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label fw-semibold small">Adress <span class="text-danger">*</span></label>
                                                        <input type="text" name="adresse" value="{{ $fournisseur->adresse }}" class="form-control form-control-sm" style="border-radius: 10px; padding: 10px 12px; font-size: 0.9rem;">
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label fw-semibold small">Contact <span class="text-danger">*</span></label>
                                                        <input type="text" name="contact" value="{{ $fournisseur->contact }}" class="form-control form-control-sm" style="border-radius: 10px; padding: 10px 12px; font-size: 0.9rem;">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer border-top-0 bg-light py-3 px-3">
                                                <div class="d-flex gap-2 w-100">
                                                    <button type="button" class="btn btn-outline-secondary flex-fill btn-sm" data-bs-dismiss="modal" style="border-radius: 10px; padding: 8px 12px;">
                                                        <i class="fas fa-times me-1"></i>Cancel
                                                    </button>
                                                    <button type="submit" class="btn btn-warning flex-fill btn-sm" style="border-radius: 10px; padding: 8px 12px; background: linear-gradient(135deg, #4caf50, #4caf50); border: none; color: white;">
                                                        <i class="fas fa-save me-1"></i>Update
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-5 text-center">
                                    <div class="py-5">
                                        <i class="fas fa-truck display-4 text-muted mb-3 opacity-50"></i>
                                        <h5 class="text-muted mb-3">Aucun fournisseur trouvé</h5>
                                        <p class="text-muted mb-4">Commencez par ajouter votre premier fournisseur</p>
                                        <button class="btn btn-primary btn-lg px-4" style="border-radius: 12px;" data-bs-toggle="modal" data-bs-target="#addFournisseurModal">
                                            <i class="fas fa-plus me-2"></i> Add Supplier
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
            Affichage de {{ $fournisseurs->firstItem() ?? 0 }} à {{ $fournisseurs->lastItem() ?? 0 }} sur {{ $fournisseurs->total() }} résultats
        </div>
        <div>
            {{ $fournisseurs->links('pagination::bootstrap-5') }}
        </div>
    </div>

</div>

<!-- AI Compose Modal (UN SEUL MODAL EN DEHORS DE LA BOUCLE) -->
<div class="modal fade" id="aiComposeModal" tabindex="-1">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-header" style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9); border-bottom: none; padding: 1.5rem 1.5rem 1rem;">
                <div class="d-flex align-items-center w-100">
                    <div class="flex-shrink-0 me-3">
                        <div class="p-2 rounded-circle" style="background: rgba(255,255,255,0.3);">
                            <i class="fas fa-robot text-success fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="modal-title fw-bold mb-0 fs-6" style="color: #2e7d32;">Compose  email with IA</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="transform: scale(0.8);"></button>
                </div>
            </div>
            <div class="modal-body p-3">
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Type of email</label>
                    <select id="emailType" class="form-select form-select-sm" style="border-radius: 10px; padding: 10px 12px; font-size: 0.9rem;">
                        <option value="price_request">Request price</option>
                        <option value="follow_up">Relance</option>
                        <option value="product_inquiry">Request products</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Content generated</label>
                    <textarea id="aiEmailOutput" class="form-control form-control-sm" rows="6" readonly style="border-radius: 10px; padding: 10px 12px; font-size: 0.9rem;"></textarea>
                </div>
            </div>
            <div class="modal-footer border-top-0 bg-light py-3 px-3">
                <button id="generateEmailBtn" class="btn btn-success flex-fill btn-sm"      style="border-radius: 10px; padding: 8px 12px; background-color: #4caf50; border-color: #4caf50;">
                    <i class="fas fa-magic me-1"></i>Generate & Send
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal d'ajout -->
<div class="modal fade" id="addFournisseurModal" tabindex="-1">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <form method="POST" action="{{ route('fournisseurs.store') }}" id="addFournisseurForm">
            @csrf
            <div class="modal-content border-0" style="border-radius: 16px; overflow: hidden;">
                <div class="modal-header" style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9); border-bottom: none; padding: 1.5rem 1.5rem 1rem;">
                    <div class="d-flex align-items-center w-100">
                        <div class="flex-shrink-0 me-3">
                            <div class="p-2 rounded-circle" style="background: rgba(255,255,255,0.3);">
                                <i class="fas fa-plus-circle text-success fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="modal-title fw-bold mb-0 fs-6" style="color: #2e7d32;">New Supplier</h5>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="transform: scale(0.8);"></button>
                    </div>
                </div>
                <div class="modal-body p-3">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold small">Name of supplier <span class="text-danger">*</span></label>
                            <input type="text" name="nom" class="form-control form-control-sm" style="border-radius: 10px; padding: 10px 12px; font-size: 0.9rem;">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold small">Adress <span class="text-danger">*</span></label>
                            <input type="text" name="adresse" class="form-control form-control-sm" style="border-radius: 10px; padding: 10px 12px; font-size: 0.9rem;">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold small">Contact <span class="text-danger">*</span></label>
                            <input type="text" name="contact" class="form-control form-control-sm" style="border-radius: 10px; padding: 10px 12px; font-size: 0.9rem;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 bg-light py-3 px-3">
                    <div class="d-flex gap-2 w-100">
                        <button type="button" class="btn btn-outline-secondary flex-fill btn-sm" data-bs-dismiss="modal" style="border-radius: 10px; padding: 8px 12px;">
                            <i class="fas fa-times me-1"></i>Cancel
                        </button>
                       <button type="submit" class="btn btn-success flex-fill btn-sm" style="border-radius: 10px; padding: 8px 12px; background-color: #4caf50; border-color: #4caf50;">
    <i class="ti ti-check me-1"></i>Create
</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- AJAX Validation Script -->
<script>
$(document).ready(function() {

    // Submit form with AJAX
    $('#addFournisseurForm').on('submit', function(e) {
        e.preventDefault();
        let form = $(this);
        form.find('.text-danger').remove();

        $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: form.serialize(),
            success: function(response) {
                $('#addFournisseurModal').modal('hide');
                alert('Fournisseur ajouté avec succès ✅');
                location.reload(); // reload the page or update table via AJAX
            },
            error: function(xhr) {
                if(xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, messages) {
                        let input = form.find('[name="'+key+'"]');
                        input.after('<span class="text-danger">'+messages[0]+'</span>');
                    });
                } else {
                    alert('Une erreur est survenue !');
                }
            }
        });
    });

    // Real-time validation
    $('#addFournisseurForm input').on('input', function() {
        let field = $(this);
        let formData = {};
        formData[field.attr('name')] = field.val();

        $.ajax({
            type: 'POST',
            url: '{{ route("fournisseurs.store") }}',
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

<!-- Scripts for dynamic filtering and AI functionality -->
<script>
// Variable globale pour stocker l'ID du fournisseur
let currentFournisseurId = null;

// ----------------------------
// Ouvrir le modal pour composer l'email IA
// ----------------------------
function openAIComposeModal(fournisseurId) {
    currentFournisseurId = fournisseurId;
    const modalEl = document.getElementById('aiComposeModal');
    document.getElementById('aiEmailOutput').value = ''; // reset textarea
    
    const modal = new bootstrap.Modal(modalEl);
    modal.show();
}

// ----------------------------
// Générer et envoyer l'email automatiquement
// ----------------------------
document.addEventListener('DOMContentLoaded', function() {
    // Table search filter
    const searchInput = document.getElementById('searchInput');
    const resetButton = document.getElementById('resetFilters');
    const tableRows = document.querySelectorAll('#fournisseurTable tbody tr');

    function filterTable() {
        const searchValue = searchInput.value.toLowerCase();
        tableRows.forEach(row => {
            const rowText = row.textContent.toLowerCase();
            row.style.display = rowText.includes(searchValue) ? '' : 'none';
        });
    }

    searchInput.addEventListener('input', filterTable);
    resetButton.addEventListener('click', function() {
        searchInput.value = '';
        filterTable();
    });

    // AI Email functionality
    const generateBtn = document.getElementById('generateEmailBtn');
    
    generateBtn.addEventListener('click', async function() {
        const type = document.getElementById('emailType').value;
        const output = document.getElementById('aiEmailOutput');

        if (!currentFournisseurId) {
            alert('❌ Aucun fournisseur sélectionné.');
            return;
        }

        // État de chargement
        const originalText = generateBtn.innerHTML;
        generateBtn.disabled = true;
        generateBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Envoi...';
        output.value = "⏳ Génération et envoi en cours...";

        try {
            const response = await fetch('{{ route("ai.generate") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    type,
                    fournisseur_id: currentFournisseurId,
                    send_email: true
                })
            });

            const data = await response.json();
            output.value = data.message || "❌ Erreur lors de la génération.";

            if (data.sent) {
                alert(`✅ Email envoyé automatiquement à ${data.contact}`);
            } else {
                alert(`❌ Email non envoyé. Vérifie la configuration SMTP.`);
            }

        } catch (err) {
            console.error(err);
            output.value = "❌ Erreur lors de la requête.";
        } finally {
            // Rétablir le bouton
            generateBtn.disabled = false;
            generateBtn.innerHTML = originalText;
        }
    });
});
</script>

<style>
.card {
    border-radius: 16px;
}

.btn {
    border-radius: 12px;
}

.modal-content {
    border-radius: 16px;
}

.table th {
    font-weight: 600;
    border-bottom: 1px solid #e9ecef;
}

.alert {
    border-radius: 12px;
}

.badge {
    border-radius: 20px;
}
</style>

@endsection