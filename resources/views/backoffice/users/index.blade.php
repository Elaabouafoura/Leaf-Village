@extends('layouts.admin')

@section('title', 'User Management - Green Spaces')

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
            <h1 class="h3 mb-2 fw-bold" style="color: #2e7d32;">User Management</h1>
            <p class="text-muted mb-0">Manage and monitor your platform users</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-5">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9); border-radius: 16px;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title text-muted mb-2">Total Users</h6>
                            <h3 class="fw-bold mb-0" style="color: #2e7d32;">{{ $totalUsers }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle" style="background: rgba(76, 175, 80, 0.1);">
                                <i class="fas fa-users fs-3" style="color: #4caf50;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #e3f2fd, #bbdefb); border-radius: 16px;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title text-muted mb-2">Active Users</h6>
                            <h3 class="fw-bold mb-0" style="color: #1976d2;">{{ $activeUsers }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle" style="background: rgba(25, 118, 210, 0.1);">
                                <i class="fas fa-user-check fs-3" style="color: #1976d2;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #fff3e0, #ffcc80); border-radius: 16px;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title text-muted mb-2">Administrators</h6>
                            <h3 class="fw-bold mb-0" style="color: #f57c00;">{{ $adminUsers }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle" style="background: rgba(245, 124, 0, 0.1);">
                                <i class="fas fa-user-shield fs-3" style="color: #f57c00;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #fce4ec, #f8bbd9); border-radius: 16px;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title text-muted mb-2">New (30d)</h6>
                            <h3 class="fw-bold mb-0" style="color: #c2185b;">{{ $newUsers }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle" style="background: rgba(194, 24, 91, 0.1);">
                                <i class="fas fa-user-plus fs-3" style="color: #c2185b;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Table Card -->
    <div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
        <div class="card-header py-4" style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9); border-bottom: none;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1 fw-bold" style="color: #2e7d32;">
                        <i class="fas fa-users me-2"></i>
                        Users List
                    </h5>
                    <p class="text-muted mb-0">Showing {{ $users->count() }} of {{ $users->total() }} users</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge rounded-pill px-3 py-2" style="background: rgba(76, 175, 80, 0.1); color: #2e7d32;">
                        <i class="fas fa-chart-bar me-1"></i>
                        {{ $users->total() }} Total
                    </span>
                </div>
            </div>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="usersTable">
                    <thead style="background: #f1f8e9;">
                        <tr>
                            <th class="ps-4 py-3 fw-semibold text-uppercase small text-muted">User</th>
                            <th class="py-3 fw-semibold text-uppercase small text-muted">Contact</th>
                            <th class="py-3 fw-semibold text-uppercase small text-muted">Role</th>
                            <th class="py-3 fw-semibold text-uppercase small text-muted">Registration</th>
                            <th class="py-3 fw-semibold text-uppercase small text-muted">Activities</th>
                            <th class="py-3 fw-semibold text-uppercase small text-muted">Events</th>
                            <th class="pe-4 py-3 fw-semibold text-uppercase small text-muted text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr class="border-bottom hover-bg">
                            <td class="ps-4 py-4">
                                <div class="d-flex align-items-start">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="user-avatar bg-success text-white rounded-circle d-flex align-items-center justify-content-center" 
                                             style="width: 40px; height: 40px; font-weight: bold;">
                                            {{ strtoupper(substr($user->prenom, 0, 1)) }}{{ strtoupper(substr($user->nom, 0, 1)) }}
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="fw-bold mb-1" style="color: #2e7d32;">{{ $user->prenom }} {{ $user->nom }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4">
                                <div class="text-dark">{{ $user->email }}</div>
                                <small class="text-muted">{{ $user->telephone ?? 'Not provided' }}</small>
                            </td>
                            <td class="py-4">
                                <span class="badge rounded-pill px-3 py-2 fw-normal" 
                                    style="background: 
                                        @if($user->role == 'Admin') rgba(111, 66, 193, 0.1); color: #6f42c1;
                                        @elseif($user->role == 'Moderator') rgba(253, 126, 20, 0.1); color: #fd7e14;
                                        @else rgba(32, 201, 151, 0.1); color: #20c997;
                                        @endif">
                                    <i class="fas 
                                        @if($user->role == 'Admin') fa-user-shield
                                        @elseif($user->role == 'Moderator') fa-user-cog
                                        @else fa-user
                                        @endif me-1">
                                    </i>
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="py-4">
                                <div class="text-dark">{{ \Carbon\Carbon::parse($user->dateInscription)->format('m/d/Y') }}</div>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($user->dateInscription)->diffForHumans() }}</small>
                            </td>
                            <td class="py-4">
                                <span class="badge rounded-pill px-3 py-2 fw-normal" style="background: rgba(232, 62, 140, 0.1); color: #e83e8c;">
                                    <i class="fas fa-hiking me-1"></i>{{ $user->activites_count ?? 0 }}
                                </span>
                            </td>
                            <td class="py-4">
                                <span class="badge rounded-pill px-3 py-2 fw-normal" style="background: rgba(111, 66, 193, 0.1); color: #6f42c1;">
                                    <i class="fas fa-calendar-alt me-1"></i>{{ $user->evenements_count ?? 0 }}
                                </span>
                            </td>
                            <td class="pe-4 py-4 text-center">
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-light rounded-circle px-3 text-danger"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteUserModal{{ $user->idUser }}"
                                            title="Delete User">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center p-4 border-top">
                <div class="text-muted small">
                    Showing <span class="fw-bold">{{ $users->firstItem() }}</span> to <span class="fw-bold">{{ $users->lastItem() }}</span> of <span class="fw-bold">{{ $users->total() }}</span> users
                </div>
                <nav>
                    {{ $users->links('pagination::bootstrap-5') }}
                </nav>
            </div>
        </div>
    </div>
</div>

@foreach($users as $user)
<!-- Delete User Modal -->
<div class="modal fade" id="deleteUserModal{{ $user->idUser }}" tabindex="-1">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-header" style="background: linear-gradient(135deg, #fce4ec, #f8bbd9); border-bottom: none; padding: 1.5rem 1.5rem 1rem;">
                <div class="d-flex align-items-center w-100">
                    <div class="flex-shrink-0 me-3">
                        <div class="p-2 rounded-circle" style="background: rgba(255,255,255,0.3);">
                            <i class="fas fa-exclamation-triangle text-danger fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="modal-title fw-bold mb-0 fs-6" style="color: #c2185b;">Confirm Deletion</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="transform: scale(0.8);"></button>
                </div>
            </div>
            <div class="modal-body p-3">
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-4 bg-red-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-trash-alt fa-2x text-danger"></i>
                    </div>
                    
                    <h4 class="fw-bold text-dark mb-2">
                        Are you sure you want to delete this user?
                    </h4>
                    
                    <p class="text-muted mb-4">
                        All data associated with this user will be permanently deleted. 
                        This action cannot be undone.
                    </p>
                    
                    <div class="bg-red-50 border border-red-200 rounded-xl p-3 mb-3">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-exclamation-circle text-danger mt-1 me-3"></i>
                            <div>
                                <p class="text-red-800 fw-medium small mb-1">
                                    User to delete:
                                </p>
                                <p class="text-red-900 fw-bold mb-0">
                                    {{ $user->prenom }} {{ $user->nom }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top-0 bg-light py-3 px-3">
                <div class="d-flex gap-2 w-100">
                    <button type="button" 
                            class="btn btn-outline-secondary flex-fill btn-sm" 
                            data-bs-dismiss="modal"
                            style="border-radius: 10px; padding: 8px 12px;">
                        <i class="fas fa-times me-1"></i>Cancel
                    </button>
                    
                    <form action="{{ route('users.destroy', $user->idUser) }}" method="POST" class="flex-fill">
                        @csrf
                        <button type="submit" 
                                class="btn btn-danger flex-fill btn-sm w-100"
                                style="border-radius: 10px; padding: 8px 12px; background: linear-gradient(135deg, #dc3545, #c82333); border: none;">
                            <i class="fas fa-trash me-1"></i>Delete Permanently
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<style>
.card {
    border-radius: 16px;
}

.btn {
    border-radius: 10px;
}

.badge {
    font-weight: 500;
}

.modal-content {
    border-radius: 16px;
}

.text-success {
    color: #2e7d32 !important;
}

.bg-success {
    background-color: #4caf50 !important;
}

.hover-bg:hover {
    background-color: #f8fdf9 !important;
}

.user-avatar {
    font-size: 14px;
}

.table th {
    font-weight: 600;
    border-bottom: 1px solid #e9ecef;
}

.alert {
    border-radius: 12px;
}
</style>

<script>
// Initialize tooltips
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

// Delete user confirmation
function deleteUser(userId) {
    document.getElementById('userToDeleteName').textContent = `User #${userId}`;
    document.getElementById('deleteUserForm').action = `/admin/users/${userId}`;
    $('#deleteUserModal').modal('show');
}

// Search functionality
document.getElementById('searchButton').addEventListener('click', function() {
    performSearch();
});

document.getElementById('searchInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        performSearch();
    }
});

function performSearch() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const rows = document.querySelectorAll('.user-row');
    
    let visibleCount = 0;
    
    rows.forEach(row => {
        const userName = row.querySelector('.fw-bold').textContent.toLowerCase();
        const userEmail = row.querySelector('.text-dark').textContent.toLowerCase();
        const userPhone = row.querySelector('.text-muted').textContent.toLowerCase();
        
        if (userName.includes(searchTerm) || userEmail.includes(searchTerm) || userPhone.includes(searchTerm)) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });
    
    // Update the user count display
    document.querySelector('.card-header .text-muted').textContent = `${visibleCount} users found`;
    
    // Show no results message
    if (visibleCount === 0 && searchTerm !== '') {
        const tbody = document.querySelector('#usersTable tbody');
        if (!document.querySelector('.no-results')) {
            const noResultsRow = document.createElement('tr');
            noResultsRow.className = 'no-results text-center';
            noResultsRow.innerHTML = `
                <td colspan="7" class="py-5">
                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No users found</h5>
                    <p class="text-muted">No results match your search</p>
                </td>
            `;
            tbody.appendChild(noResultsRow);
        }
    } else {
        const noResultsRow = document.querySelector('.no-results');
        if (noResultsRow) {
            noResultsRow.remove();
        }
    }
}

// Add hover effects to table rows
document.addEventListener('DOMContentLoaded', function() {
    const rows = document.querySelectorAll('.user-row');
    rows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(4px)';
            this.style.transition = 'transform 0.2s ease';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
        });
    });
});
</script>
@endsection