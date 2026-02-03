@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="col-lg-6 mx-auto">
        <div class="card shadow border-0">
            <div class="card-body">

                <h4 class="mb-3">Payment</h4>

                <p><strong>Booking ID:</strong> #{{ $booking->id }}</p>
                <p><strong>Total Price:</strong> ${{ number_format($booking->total_price) }}</p>

                <form method="POST" action="{{ route('user.payment.process', $booking->id) }}">
                    @csrf
                    <button class="btn btn-success w-100">
                        Pay Now (Mock)
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection