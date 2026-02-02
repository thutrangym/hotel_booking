@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h2 class="mb-4 fw-bold">Admin Dashboard</h2>

    {{-- STAT CARDS --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card p-3 shadow-sm">🏨 Rooms: {{ $totalRooms }}</div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm">📅 Today Bookings: {{ $todayBookings }}</div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm">🛏 Available: {{ $availableRooms }}</div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm">👤 Users: {{ $totalUsers }}</div>
        </div>
    </div>

    {{-- LATEST BOOKINGS --}}
    <div class="card shadow-sm">
        <div class="card-header fw-semibold">Latest Bookings</div>
        <div class="card-body">
            <table class="table table-sm">
                <tr>
                    <th>User</th>
                    <th>Room</th>
                    <th>Check-in</th>
                    <th>Status</th>
                </tr>
                @foreach($latestBookings as $booking)
                <tr>
                    <td>{{ $booking->user->name }}</td>
                    <td>{{ $booking->room->name }}</td>
                    <td>{{ $booking->check_in }}</td>
                    <td>{{ $booking->status }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>

</div>
@endsection