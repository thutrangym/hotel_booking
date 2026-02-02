@extends('layouts.app')

@section('content')
<div class="container py-5">
    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-black text-dark mb-1">Bookings Management</h2>
            <p class="text-muted small">Manage reservations and update room status manually.</p>
        </div>
    </div>
    <div id="toast-container" class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999"></div>


    @if(session('success'))
    <div class="alert alert-success border-0 shadow-sm rounded-4 alert-dismissible fade show mb-4" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="bg-light border-bottom">
                    <tr>
                        <th class="ps-4 py-3 text-uppercase small fw-black text-muted">ID</th>
                        <th class="py-3 text-uppercase small fw-black text-muted">Customer</th>
                        <th class="py-3 text-uppercase small fw-black text-muted">Room Info</th>
                        <th class="py-3 text-uppercase small fw-black text-muted">Schedule</th>
                        <th class="py-3 text-uppercase small fw-black text-muted">Total</th>
                        <th class="py-3 text-uppercase small fw-black text-muted" width="220">Status & Update</th>
                        <th class="py-3 text-uppercase small fw-black text-muted text-end pe-4">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($bookings as $booking)
                    <tr class="hover-row">
                        <td class="ps-4 text-muted fw-bold">#{{ $booking->id }}</td>

                        <td>
                            <div class="fw-bold text-dark">{{ $booking->user->name ?? 'N/A' }}</div>
                            <div class="text-muted small italic">{{ $booking->user->email ?? '' }}</div>
                        </td>

                        <td>
                            <div class="fw-bold text-primary">{{ $booking->room->name ?? 'N/A' }}</div>
                            <span class="badge bg-gray-200 text-dark fw-normal">Qty: {{ $booking->quantity }}</span>
                        </td>

                        <td>
                            <div class="small fw-bold">
                                {{ \Carbon\Carbon::parse($booking->check_in)->format('d/m/y') }}
                                <i class="bi bi-arrow-right text-muted mx-1"></i>
                                {{ \Carbon\Carbon::parse($booking->check_out)->format('d/m/y') }}
                            </div>
                        </td>

                        <td><span class="fw-black text-dark">${{ number_format($booking->total_price, 2) }}</span></td>

                        <td>

                            <form
                                action="{{ route('admin.bookings.updateStatus', ['booking' => $booking->id]) }}"
                                method="POST"
                                class="d-flex gap-2 align-items-center">
                                @csrf
                                @method('PATCH')

                                <select name="status" class="form-select form-select-sm">
                                    <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="confirmed" {{ $booking->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    <option value="completed" {{ $booking->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>

                                <button type="submit" class="btn btn-dark fw-bold px-2 shadow-sm btn-save-status">
                                    <i class="bi bi-check-lg"></i>
                                </button>
                            </form>

                        </td>

                        <td class="text-end pe-4">
                            <div class="btn-group shadow-sm rounded-pill overflow-hidden">
                                <a href="{{ route('admin.bookings.show', $booking) }}" class="btn btn-white btn-sm border-gray-200 px-3" title="View Detail">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete booking?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-white btn-sm border-gray-200 text-danger px-3" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted italic">No bookings found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

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
        transition: 0.2s;
    }

    .btn-white {
        background: #fff;
        color: #666;
    }

    .btn-white:hover {
        background: #f8f9fa;
        color: #333;
    }

    .input-group-sm>.form-select {
        font-size: 0.75rem;
    }

    .table thead th {
        border-top: none;
    }
</style>
@endsection

<script>
    document.querySelectorAll('.ajax-status-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const bookingId = this.dataset.id;
            const status = this.querySelector('select[name="status"]').value;
            const btn = this.querySelector('.btn-save-status');
            const originalContent = btn.innerHTML;


            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span>';

            fetch(`/admin/bookings/${bookingId}/status`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        status: status
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast('Success', 'Booking status updated successfully!', 'success');
                    } else {
                        showToast('Error', 'Something went wrong.', 'danger');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Error', 'Connection failed.', 'danger');
                })
                .finally(() => {
                    btn.disabled = false;
                    btn.innerHTML = originalContent;
                });
        });
    });


    function showToast(title, message, type) {
        const toastContainer = document.getElementById('toast-container');
        const id = 'toast-' + Date.now();
        const toastHtml = `
        <div id="${id}" class="toast align-items-center text-white bg-${type} border-0 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <strong>${title}:</strong> ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    `;
        toastContainer.insertAdjacentHTML('beforeend', toastHtml);
        const toastElement = document.getElementById(id);
        const bsToast = new bootstrap.Toast(toastElement, {
            delay: 3000
        });
        bsToast.show();


        toastElement.addEventListener('hidden.bs.toast', () => toastElement.remove());
    }
</script>