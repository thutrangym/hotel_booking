@extends('layouts.app')

@section('content')
<div class="container py-5">
    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-black text-dark mb-1">Rooms</h2>
            <p class="text-muted small mb-0">Manage your room listings and availability.</p>
        </div>
        <a href="{{ route('admin.rooms.create') }}" class="btn btn-dark rounded-pill px-4 shadow-sm fw-bold">
            <i class="bi bi-plus-lg me-1"></i> Add Room
        </a>
    </div>

    {{-- Alert --}}
    @if(session('success'))
    <div class="alert alert-success border-0 shadow-sm rounded-4 alert-dismissible fade show mb-4" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- Table Wrapper --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light border-bottom">
                    <tr>
                        <th class="ps-4 py-3 text-uppercase small fw-black text-muted">Name</th>
                        <th class="py-3 text-uppercase small fw-black text-muted">Price</th>
                        <th class="py-3 text-uppercase small fw-black text-muted">Total</th>
                        <th class="py-3 text-uppercase small fw-black text-muted">Available</th>
                        <th class="py-3 text-uppercase small fw-black text-muted">Status</th>
                        <th class="py-3 text-uppercase small fw-black text-muted text-end pe-4" width="180">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rooms as $room)
                    <tr class="hover-row">
                        <td class="ps-4 py-3">
                            <a href="{{ route('admin.rooms.show', $room) }}"
                                class="fw-bold text-decoration-none text-dark hover-primary">
                                {{ $room->name }}
                            </a>
                        </td>

                        <td class="py-3 fw-bold text-dark">
                            {{ number_format($room->price, 0) }} VND
                        </td>

                        <td class="py-3">
                            <span class="badge bg-light text-dark border fw-normal px-3">{{ $room->total_rooms }} Rooms</span>
                        </td>

                        <td class="py-3 text-center">
                            <div class="fw-bold {{ $room->available_rooms > 0 ? 'text-primary' : 'text-danger' }}">
                                {{ $room->available_rooms }}
                            </div>
                        </td>

                        <td class="py-3 text-center">
                            @if($room->status === 'available')
                            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3">Available</span>
                            @else
                            <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-3">Hidden</span>
                            @endif
                        </td>

                        <td class="text-end pe-4 py-3">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.rooms.edit', $room) }}" class="btn btn-sm btn-outline-warning rounded-pill px-3 fw-bold shadow-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>

                                <form action="{{ route('admin.rooms.destroy', $room) }}"
                                    method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-bold shadow-sm"
                                        onclick="return confirm('Delete this room?')">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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

    .hover-primary:hover {
        color: #0d6efd !important;
    }

    .table thead th {
        border-top: none;
        letter-spacing: 0.05em;
        font-size: 0.75rem;
    }

    /* Badge colors */
    .bg-success-subtle {
        background-color: #d1e7dd !important;
    }

    .bg-secondary-subtle {
        background-color: #e2e3e5 !important;
    }
</style>
@endsection