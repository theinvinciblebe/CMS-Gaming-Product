@extends('dashboard-layout.main')

@section('content')
<style>
    /* ==========================================================================
       Gaming CMS User Management Styles (Light & Dark Mode)
       ========================================================================== */
    .cms-user-container {
        padding: 1.75rem 2rem 3rem 2rem;
        background: radial-gradient(circle at 15% 10%, rgba(99, 102, 241, 0.08) 0%, transparent 40%),
                    radial-gradient(circle at 85% 30%, rgba(6, 182, 212, 0.07) 0%, transparent 40%),
                    var(--cms-page-bg);
        min-height: calc(100vh - 57px);
        color: var(--cms-text-primary);
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    @keyframes cmsFadeInUp {
        from {
            opacity: 0;
            transform: translateY(18px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-entry {
        animation: cmsFadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) both;
    }
    .delay-1 { animation-delay: 0.08s; }
    .delay-2 { animation-delay: 0.16s; }

    /* Header Bar */
    .cms-page-header {
        position: relative;
        border-radius: 20px;
        padding: 1.75rem 2.25rem;
        background: var(--cms-hero-bg);
        border: 1px solid var(--cms-hero-border);
        box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.06);
        backdrop-filter: blur(24px);
        margin-bottom: 1.75rem;
        transition: all 0.3s ease;
    }
    html.dark .cms-page-header {
        box-shadow: 0 18px 40px -12px rgba(0, 0, 0, 0.6);
    }

    /* KPI Mini Grid */
    .cms-user-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
        gap: 1.25rem;
        margin-bottom: 1.75rem;
    }

    .cms-user-stat-card {
        background: var(--cms-card-bg);
        border: 1px solid var(--cms-border);
        border-radius: 16px;
        padding: 1.25rem 1.4rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 10px 25px -8px rgba(0, 0, 0, 0.05);
        transition: transform 0.25s ease, border-color 0.25s ease;
    }
    html.dark .cms-user-stat-card {
        box-shadow: 0 12px 30px -10px rgba(0, 0, 0, 0.5);
    }
    .cms-user-stat-card:hover {
        transform: translateY(-3px);
        border-color: var(--cms-border-glow);
    }

    /* Glass Table Container */
    .cms-table-card {
        background: var(--cms-card-bg);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid var(--cms-border);
        border-radius: 18px;
        box-shadow: 0 10px 30px -8px rgba(0, 0, 0, 0.06);
        overflow: hidden;
        transition: all 0.3s ease;
    }
    html.dark .cms-table-card {
        box-shadow: 0 14px 36px -10px rgba(0, 0, 0, 0.55);
    }

    .cms-table-toolbar {
        padding: 1.25rem 1.75rem;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        border-bottom: 1px solid var(--cms-border);
    }

    .cms-search-box {
        position: relative;
        min-width: 260px;
    }
    .cms-search-box i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--cms-text-muted);
        font-size: 0.85rem;
    }
    .cms-search-input {
        width: 100%;
        padding: 0.6rem 1rem 0.6rem 2.4rem;
        border-radius: 12px;
        border: 1px solid var(--cms-border);
        background: rgba(0, 0, 0, 0.03);
        color: var(--cms-text-primary);
        font-size: 0.875rem;
        transition: all 0.25s ease;
        outline: none !important;
    }
    html.dark .cms-search-input {
        background: rgba(255, 255, 255, 0.04);
    }
    .cms-search-input:focus {
        border-color: var(--cms-primary);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
    }

    /* Table Styling */
    .cms-table {
        width: 100%;
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
    }
    .cms-table th {
        background: rgba(0, 0, 0, 0.03);
        color: var(--cms-text-muted);
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        padding: 1rem 1.5rem;
        border-top: none;
        border-bottom: 1px solid var(--cms-border);
    }
    html.dark .cms-table th {
        background: rgba(255, 255, 255, 0.03);
    }
    .cms-table td {
        padding: 1.15rem 1.5rem;
        vertical-align: middle;
        border-top: none;
        border-bottom: 1px solid var(--cms-border);
        color: var(--cms-text-secondary);
        font-size: 0.9rem;
        transition: background-color 0.2s ease;
    }
    .cms-table tbody tr:hover td {
        background: rgba(99, 102, 241, 0.05);
    }
    .cms-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* User Avatar */
    .cms-avatar {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.95rem;
        color: white;
        background: linear-gradient(135deg, #6366f1, #06b6d4);
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        flex-shrink: 0;
    }

    /* Badges */
    .cms-badge-role {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        background: rgba(99, 102, 241, 0.12);
        color: #6366f1;
        border: 1px solid rgba(99, 102, 241, 0.3);
    }
    html.dark .cms-badge-role {
        color: #a5b4fc;
    }

    /* Action Buttons */
    .btn-action-edit {
        background: rgba(99, 102, 241, 0.1);
        border: 1px solid rgba(99, 102, 241, 0.3);
        color: #6366f1 !important;
        padding: 0.45rem 0.9rem;
        border-radius: 10px;
        font-size: 0.825rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease;
        cursor: pointer;
    }
    .btn-action-edit:hover {
        background: #6366f1;
        color: #ffffff !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4);
    }

    .delete-form {
        margin: 0 !important;
        padding: 0 !important;
        display: inline-flex;
        vertical-align: middle;
    }

    .btn-action-delete {
        margin: 0 !important;
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.3);
        color: #ef4444 !important;
        padding: 0.45rem 0.9rem;
        border-radius: 10px;
        font-size: 0.825rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease;
        cursor: pointer;
    }
    .btn-action-delete:hover {
        background: #ef4444;
        color: #ffffff !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
    }

    /* ==========================================================================
       MODAL STYLING (Full Light / Dark Support)
       ========================================================================== */
    .modal-content {
        background: var(--cms-card-bg) !important;
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
        border: 1px solid var(--cms-border) !important;
        border-radius: 20px !important;
        color: var(--cms-text-primary) !important;
        box-shadow: 0 24px 50px -12px rgba(0, 0, 0, 0.6) !important;
    }
    .modal-header {
        border-bottom: 1px solid var(--cms-border) !important;
        padding: 1.5rem 1.75rem !important;
    }
    .modal-title {
        font-family: 'Outfit', sans-serif !important;
        font-weight: 800 !important;
        color: var(--cms-text-primary) !important;
        font-size: 1.35rem;
    }
    .modal-body {
        padding: 1.75rem !important;
    }
    .modal-footer {
        border-top: 1px solid var(--cms-border) !important;
        padding: 1.25rem 1.75rem !important;
    }

    .cms-form-label {
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--cms-text-secondary);
        margin-bottom: 6px;
        display: block;
    }
    .cms-form-control {
        width: 100%;
        padding: 0.7rem 1.15rem;
        border-radius: 12px;
        border: 1px solid var(--cms-border);
        background: rgba(0, 0, 0, 0.04);
        color: var(--cms-text-primary) !important;
        font-size: 0.9rem;
        outline: none !important;
        transition: all 0.25s ease;
    }
    html.dark .cms-form-control {
        background: rgba(15, 23, 42, 0.85);
        color: #ffffff !important;
    }
    .cms-form-control:focus {
        border-color: var(--cms-primary);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.25);
    }
    .cms-form-control::placeholder {
        color: var(--cms-text-muted);
        opacity: 0.75;
    }

    .btn-modal-close {
        background: transparent;
        border: none;
        color: var(--cms-text-muted);
        font-size: 1.25rem;
        cursor: pointer;
        padding: 4px 8px;
        transition: color 0.2s ease;
    }
    .btn-modal-close:hover {
        color: var(--cms-text-primary);
    }
</style>

<div class="cms-user-container">
    <!-- =========================================================================
         1. PAGE HEADER HUD
         ========================================================================= -->
    <div class="cms-page-header animate-entry">
        <div class="row align-items-center">
            <div class="col-lg-8 col-md-7 mb-3 mb-md-0">
                <div class="d-flex align-items-center gap-3 mb-2" style="gap: 12px;">
                    <span class="cms-badge-role">
                        <i class="fas fa-shield-alt"></i> Access Control
                    </span>
                    <span style="font-size: 0.8rem; color: var(--cms-text-muted); font-family: 'JetBrains Mono', monospace;">
                        <i class="fas fa-lock mr-1"></i> Bcrypt Hashed • Auth Guards
                    </span>
                </div>
                <h1 style="font-size: 2.15rem; font-weight: 800; color: var(--cms-text-primary); margin-bottom: 0.35rem;">
                    User Management
                </h1>
                <p style="color: var(--cms-text-muted); font-size: 0.95rem; margin-bottom: 0;">
                    Manage administrator and staff accounts, credentials, and access credentials with instant database synchronization.
                </p>
            </div>
            <div class="col-lg-4 col-md-5 text-md-right">
                <button type="button" class="btn-cms-primary" data-toggle="modal" data-target="#addUserModal">
                    <i class="fas fa-user-plus"></i> Add New User
                </button>
            </div>
        </div>
    </div>

    <!-- Validation Errors Display -->
    @if ($errors->any())
        <div class="alert alert-danger animate-entry mb-4" style="border-radius: 14px; background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3); color: #f87171;">
            <div class="d-flex align-items-center gap-2 mb-1" style="gap: 8px;">
                <i class="fas fa-exclamation-triangle"></i>
                <strong style="color: #fca5a5;">Please correct the following errors:</strong>
            </div>
            <ul class="mb-0 pl-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- =========================================================================
         2. KPI STATS ROW
         ========================================================================= -->
    <div class="cms-user-stats animate-entry delay-1">
        <!-- Card 1: Total Users -->
        <div class="cms-user-stat-card">
            <div>
                <span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: var(--cms-text-muted); font-weight: 700; display: block; margin-bottom: 4px;">
                    Total Accounts
                </span>
                <div style="font-size: 1.75rem; font-weight: 800; color: var(--cms-text-primary); line-height: 1.1;">
                    {{ count($users) }} <span style="font-size: 0.85rem; font-weight: 600; color: #6366f1;">Registered</span>
                </div>
                <div style="font-size: 0.75rem; color: #10b981; margin-top: 5px; font-weight: 600;">
                    <i class="fas fa-check-circle"></i> Active in Database
                </div>
            </div>
            <div class="cms-stat-icon" style="background: var(--cms-primary-gradient);">
                <i class="fas fa-users"></i>
            </div>
        </div>

        <!-- Card 2: Administrator Accounts -->
        <div class="cms-user-stat-card">
            <div>
                <span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: var(--cms-text-muted); font-weight: 700; display: block; margin-bottom: 4px;">
                    Current Session
                </span>
                <div style="font-size: 1.75rem; font-weight: 800; color: var(--cms-text-primary); line-height: 1.1;">
                    {{ Auth::user()->name ?? 'Admin' }}
                </div>
                <div style="font-size: 0.75rem; color: #0284c7; margin-top: 5px; font-weight: 600;">
                    <i class="fas fa-user-shield"></i> Logged In Administrator
                </div>
            </div>
            <div class="cms-stat-icon" style="background: var(--cms-cyan-gradient);">
                <i class="fas fa-id-badge"></i>
            </div>
        </div>

        <!-- Card 3: Security Status -->
        <div class="cms-user-stat-card">
            <div>
                <span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: var(--cms-text-muted); font-weight: 700; display: block; margin-bottom: 4px;">
                    Password Security
                </span>
                <div style="font-size: 1.75rem; font-weight: 800; color: var(--cms-text-primary); line-height: 1.1;">
                    100% <span style="font-size: 0.85rem; font-weight: 600; color: #059669;">Bcrypt Encrypted</span>
                </div>
                <div style="font-size: 0.75rem; color: #059669; margin-top: 5px; font-weight: 600;">
                    <i class="fas fa-shield-alt"></i> Hashed Password Cast
                </div>
            </div>
            <div class="cms-stat-icon" style="background: var(--cms-emerald-gradient);">
                <i class="fas fa-lock"></i>
            </div>
        </div>
    </div>

    <!-- =========================================================================
         3. USERS DATA TABLE CARD
         ========================================================================= -->
    <div class="cms-table-card animate-entry delay-2">
        <div class="cms-table-toolbar">
            <div class="d-flex align-items-center gap-3" style="gap: 12px;">
                <span style="font-family: 'Outfit', sans-serif; font-size: 1.15rem; font-weight: 800; color: var(--cms-text-primary);">
                    Registered User Directory
                </span>
                <span style="background: rgba(99, 102, 241, 0.12); color: var(--cms-primary); font-size: 0.75rem; font-weight: 700; padding: 2px 10px; border-radius: 9999px;">
                    {{ count($users) }} Records
                </span>
            </div>

            <!-- Instant Client-side Search Filter -->
            <div class="cms-search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="userSearchInput" class="cms-search-input" placeholder="Search by name or email..." onkeyup="filterUserTable()">
            </div>
        </div>

        <div class="table-responsive">
            <table class="cms-table" id="userTable">
                <thead>
                    <tr>
                        <th style="width: 70px;">#</th>
                        <th>User Account</th>
                        <th>Email Address</th>
                        <th>Role / Status</th>
                        <th class="text-right" style="width: 180px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                        <tr class="user-row">
                            <td style="font-family: 'JetBrains Mono', monospace; font-size: 0.85rem; color: var(--cms-text-muted);">
                                #{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-3" style="gap: 12px;">
                                    <div class="cms-avatar">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div style="font-weight: 700; color: var(--cms-text-primary); font-size: 0.95rem;">
                                            {{ $user->name }}
                                        </div>
                                        <div style="font-size: 0.78rem; color: var(--cms-text-muted);">
                                            User ID: {{ $user->id }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span style="font-family: 'JetBrains Mono', monospace; font-size: 0.875rem;">
                                    <i class="fas fa-envelope mr-1" style="color: var(--cms-text-muted); font-size: 0.8rem;"></i>
                                    {{ $user->email ?? 'N/A' }}
                                </span>
                            </td>
                            <td>
                                <span class="cms-badge-role">
                                    <i class="fas fa-user-check"></i>
                                    Administrator
                                </span>
                            </td>
                            <td class="text-right">
                                <div class="d-inline-flex align-items-center gap-2" style="gap: 8px;">
                                    <button type="button" class="btn-action-edit" onclick="showEditModal({{ $user->id }}, '{{ addslashes($user->name) }}', '{{ addslashes($user->email) }}')">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>

                                    <form action="{{ route('user.delete', $user->id) }}" method="POST" class="delete-form m-0 p-0" style="display: inline-flex; margin: 0; padding: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn-action-delete delete-btn m-0" style="margin: 0;">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div style="color: var(--cms-text-muted); font-size: 1rem;">
                                    <i class="fas fa-users-slash fa-2x mb-2 d-block" style="opacity: 0.5;"></i>
                                    No users found in the database.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- =========================================================================
     4. MODAL: ADD NEW USER
     ========================================================================= -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('user.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">
                        <i class="fas fa-user-plus mr-2" style="color: #6366f1;"></i> Add New User
                    </h5>
                    <button type="button" class="btn-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label class="cms-form-label"><i class="fas fa-user mr-1 text-primary"></i> Full Name / Username</label>
                        <input type="text" name="name" class="cms-form-control" placeholder="e.g. admin or john_doe" required autocomplete="off">
                    </div>
                    <div class="form-group mb-3">
                        <label class="cms-form-label"><i class="fas fa-envelope mr-1 text-info"></i> Email Address</label>
                        <input type="email" name="email" class="cms-form-control" placeholder="e.g. user@example.com" required autocomplete="off">
                    </div>
                    <div class="form-group mb-2">
                        <label class="cms-form-label"><i class="fas fa-key mr-1 text-success"></i> Password</label>
                        <input type="password" name="password" class="cms-form-control" placeholder="At least 6 characters" required autocomplete="new-password">
                        <small style="color: var(--cms-text-muted); font-size: 0.78rem; display: block; margin-top: 4px;">
                            Password will be automatically hashed with Bcrypt before saving.
                        </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cms-outline" data-dismiss="modal" style="padding: 0.55rem 1.25rem;">
                        Cancel
                    </button>
                    <button type="submit" class="btn-cms-primary" style="padding: 0.55rem 1.5rem;">
                        <i class="fas fa-save mr-1"></i> Create User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- =========================================================================
     5. MODAL: EDIT USER
     ========================================================================= -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="edit-user-form" method="POST" action="{{ route('user.update') }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit-user-id">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">
                        <i class="fas fa-user-edit mr-2" style="color: #06b6d4;"></i> Edit User Details
                    </h5>
                    <button type="button" class="btn-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="edit-user-name" class="cms-form-label"><i class="fas fa-user mr-1 text-primary"></i> Full Name / Username</label>
                        <input type="text" class="cms-form-control" id="edit-user-name" name="name" required autocomplete="off">
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit-user-email" class="cms-form-label"><i class="fas fa-envelope mr-1 text-info"></i> Email Address</label>
                        <input type="email" class="cms-form-control" id="edit-user-email" name="email" required autocomplete="off">
                    </div>
                    <div class="form-group mb-2">
                        <label for="edit-user-password" class="cms-form-label"><i class="fas fa-key mr-1 text-success"></i> New Password</label>
                        <input type="password" class="cms-form-control" id="edit-user-password" name="password" placeholder="Leave blank to keep current password" autocomplete="new-password">
                        <small style="color: var(--cms-text-muted); font-size: 0.78rem; display: block; margin-top: 4px;">
                            Only fill this field if you wish to reset or change the user's password.
                        </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cms-outline" data-dismiss="modal" style="padding: 0.55rem 1.25rem;">
                        Cancel
                    </button>
                    <button type="submit" class="btn-cms-primary" style="padding: 0.55rem 1.5rem; background: var(--cms-cyan-gradient);">
                        <i class="fas fa-check-circle mr-1"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- =========================================================================
     6. JAVASCRIPT LOGIC
     ========================================================================= -->
<script type="text/javascript">
    function showEditModal(id, name, email) {
        document.getElementById('edit-user-id').value = id;
        document.getElementById('edit-user-name').value = name;
        document.getElementById('edit-user-email').value = email;
        document.getElementById('edit-user-password').value = '';

        if (window.$) {
            $('#editUserModal').modal('show');
        } else if (window.bootstrap && window.bootstrap.Modal) {
            new bootstrap.Modal(document.getElementById('editUserModal')).show();
        }
    }

    function filterUserTable() {
        const query = document.getElementById('userSearchInput').value.toLowerCase();
        const rows = document.querySelectorAll('#userTable tbody .user-row');
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(query) ? '' : 'none';
        });
    }
</script>
@endsection
