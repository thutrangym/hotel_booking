@extends('layouts.app')

@section('content')
<div class="container py-5">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-black text-dark mb-1">Bookings Management</h2>
            <p class="text-muted small">Manage reservations and update room status manually.</p>
        </div>
    </div>

    {{-- Flash success --}}
    @if(session('success'))
    <div class="alert alert-success border-0 shadow-sm rounded-4 alert-dismissible fade show mb-4">
        <i class="bi bi-check-circle-fill me-2"></i>
        {{ session('success') }}
        <button class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    {{-- Table --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="bg-light border-bottom">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Customer</th>
                        <th>Room Info</th>
                        <th>Schedule</th>
                        <th>Total</th>
                        <th width="220">Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($bookings as $booking)
                    <tr class="hover-row">
                        {{-- ID --}}
                        <td class="ps-4 fw-bold text-muted">#{{ $booking->id }}</td>

                        {{-- Customer --}}
                        <td>
                            <div class="fw-bold">{{ $booking->user->name ?? 'N/A' }}</div>
                            <div class="small text-muted">{{ $booking->user->email ?? '' }}</div>
                        </td>

                        {{-- Room --}}
                        <td>
                            <div class="fw-bold text-primary"><a href="{{ route('admin.rooms.show', $booking->room) }}" class="text-decoration-none">{{ $booking->room->name ?? 'N/A' }}</a></div>
                            <span class="badge bg-gray-200 text-dark">Qty: {{ $booking->quantity }}</span>
                        </td>

                        {{-- Schedule --}}
                        <td>
                            <div class="small fw-bold">
                                {{ \Carbon\Carbon::parse($booking->check_in)->format('d/m/Y') }}
                                →
                                {{ \Carbon\Carbon::parse($booking->check_out)->format('d/m/Y') }}
                            </div>
                        </td>

                        {{-- Total --}}
                        <td class="fw-black">${{ number_format($booking->total_price, 2) }}</td>

                        {{-- Status --}}
                        <td>
                            <form method="POST"
                                action="{{ route('admin.bookings.update', $booking) }}"
                                class="d-flex gap-2 align-items-center">
                                @csrf
                                @method('PATCH')

                                <select name="status" class="form-select form-select-sm">
                                    @foreach(['pending','confirmed','checked_in','checked_out','completed','cancelled'] as $status)
                                    <option value="{{ $status }}"
                                        @selected($booking->status === $status)>
                                        {{ ucfirst(str_replace('_',' ', $status)) }}
                                    </option>
                                    @endforeach
                                </select>

                                <button class="btn btn-dark btn-sm px-2">
                                    <i class="bi bi-check-lg"></i>
                                </button>
                            </form>
                        </td>

                        {{-- Actions --}}
                        <td class="text-end pe-4">
                            <div class="btn-group shadow-sm rounded-pill overflow-hidden">
                                <a href="{{ route('admin.bookings.show', $booking) }}"
                                    class="btn btn-white btn-sm px-3">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <form method="POST"
                                    action="{{ route('admin.bookings.destroy', $booking) }}"
                                    onsubmit="return confirm('Delete booking?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-white btn-sm text-danger px-3">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            No bookings found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Styles giữ nguyên --}}
<style>
    .fw-black {
        font-weight: 900;
    }

    .bg-gray-200 {
        background-color: #e9ecef;
    }

    .rounded-4 {
        border-radius: 1rem !important;
    }

    .hover-row:hover {
        background-color: #f9fbff;
        transition: .2s;
    }

    .btn-white {
        background: #fff;
        color: #666;
    }

    .btn-white:hover {
        background: #f8f9fa;
        color: #333;
    }
</style>
@endsection