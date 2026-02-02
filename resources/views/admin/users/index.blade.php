@extends('layouts.app')

@section('content')
<div class="container py-5">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h2 class="fw-black text-dark mb-1">User Management</h2>
            <p class="text-muted small mb-0">Manage system access levels and user profiles.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn btn-dark rounded-pill px-4 shadow-sm fw-bold">
            <i class="bi bi-person-plus-fill me-2"></i>Add User
        </a>
    </div>

    {{-- Flash success --}}
    @if(session('success'))
    <div class="alert alert-success border-0 shadow-sm rounded-4 alert-dismissible fade show mb-4" role="alert">
        <div class="d-flex align-items-center">
            <i class="bi bi-check-circle-fill me-2"></i>
            <div>{{ session('success') }}</div>
        </div>
        <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- Users Table Card --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light border-bottom">
                        <tr>
                            <th class="ps-4 py-3 text-uppercase small fw-black text-muted" width="80">ID</th>
                            <th class="py-3 text-uppercase small fw-black text-muted">User Info</th>
                            <th class="py-3 text-uppercase small fw-black text-muted">Phone</th>
                            <th class="py-3 text-uppercase small fw-black text-muted text-center" width="120">Role</th>
                            <th class="py-3 text-uppercase small fw-black text-muted" width="160">Joined Date</th>
                            <th class="py-3 text-uppercase small fw-black text-muted text-end pe-4" width="200">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr class="hover-row">
                            <td class="ps-4 text-muted fw-bold">#{{ $user->id }}</td>

                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm me-3">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">{{ $user->name }}</div>
                                        <div class="text-muted small">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>

                            <td class="text-muted">{{ $user->phone ?? '-' }}</td>

                            <td class="text-center">
                                @if($user->role === 'admin')
                                <span class="badge rounded-pill bg-danger-subtle text-danger border border-danger-subtle px-3">
                                    Admin
                                </span>
                                @else
                                <span class="badge rounded-pill bg-light text-dark border px-3">
                                    User
                                </span>
                                @endif
                            </td>

                            <td class="text-muted small">
                                <i class="bi bi-calendar3 me-1"></i>
                                {{ $user->created_at?->format('d/m/Y') }}
                            </td>

                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-1">
                                    <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-light-info rounded-circle shadow-sm" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-light-warning rounded-circle shadow-sm" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    @if(auth()->id() !== $user->id)
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-light-danger rounded-circle shadow-sm" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted italic">
                                <i class="bi bi-people fs-1 d-block mb-2"></i>
                                No users found in the system.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination Footer --}}
        @if($users->hasPages())
        <div class="card-footer bg-white border-top py-3">
            <div class="d-flex justify-content-center">
                {{ $users->links() }}
            </div>
        </div>
        @endif
    </div>

</div>

<style>
    body {
        background-color: #fcfcfc;
    }

    .fw-black {
        font-weight: 900;
    }

    .rounded-4 {
        border-radius: 1rem !important;
    }

    .hover-row:hover {
        background-color: #f8fbff;
        transition: 0.2s;
    }

    /* Avatar Style */
    .avatar-sm {
        width: 38px;
        height: 38px;
        background: #f1f3f5;
        color: #495057;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 900;
        font-size: 0.85rem;
        border: 1px solid #e9ecef;
    }

    /* Action Buttons Style */
    .btn-light-info {
        background: #e0f7fa;
        color: #00bcd4;
        border: none;
    }

    .btn-light-warning {
        background: #fff8e1;
        color: #ffb300;
        border: none;
    }

    .btn-light-danger {
        background: #ffebee;
        color: #f44336;
        border: none;
    }

    .btn-light-info:hover,
    .btn-light-warning:hover,
    .btn-light-danger:hover {
        transform: translateY(-2px);
        transition: 0.2s;
    }

    .rounded-circle {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    /* Custom Badges */
    .bg-danger-subtle {
        background-color: #fee2e2 !important;
    }
</style>
@endsection