@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-black mb-1">User Detail</h3>
            <p class="text-muted small">View user information</p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning fw-bold">
                Edit
            </a>
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                Back
            </a>
        </div>
    </div>

    <div class="row">
        {{-- LEFT: BASIC INFO --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body">
                    <h5 class="fw-black mb-3">Basic Information</h5>

                    <div class="mb-2">
                        <span class="text-muted">Name:</span>
                        <div class="fw-bold">{{ $user->name }}</div>
                    </div>

                    <div class="mb-2">
                        <span class="text-muted">Email:</span>
                        <div class="fw-bold">{{ $user->email }}</div>
                    </div>

                    <div class="mb-2">
                        <span class="text-muted">Role:</span>
                        <span class="badge {{ $user->role === 'admin' ? 'bg-danger' : 'bg-primary' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>

                    <div class="mb-2">
                        <span class="text-muted">Created at:</span>
                        <div>{{ $user->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- RIGHT: PROFILE INFO --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body">
                    <h5 class="fw-black mb-3">Profile Information</h5>

                    <div class="mb-2">
                        <span class="text-muted">Phone:</span>
                        <div>{{ $user->phone ?? '—' }}</div>
                    </div>

                    <div class="mb-2">
                        <span class="text-muted">Address:</span>
                        <div>{{ $user->address ?? '—' }}</div>
                    </div>

                    <div class="mb-2">
                        <span class="text-muted">Date of Birth:</span>
                        <div>
                            {{ $user->dob ? \Carbon\Carbon::parse($user->dob)->format('d/m/Y') : '—' }}
                        </div>
                    </div>

                    <div class="mb-2">
                        <span class="text-muted">Updated at:</span>
                        <div>{{ $user->updated_at->format('d/m/Y H:i') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Danger zone --}}
    @if(auth()->id() !== $user->id)
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body">
            <h5 class="fw-black text-danger mb-3">Danger Zone</h5>

            <form action="{{ route('admin.users.destroy', $user) }}"
                method="POST"
                onsubmit="return confirm('Delete this user?')">
                @csrf
                @method('DELETE')

                <button class="btn btn-danger fw-bold">
                    Delete User
                </button>
            </form>
        </div>
    </div>
    @endif

</div>
@endsection