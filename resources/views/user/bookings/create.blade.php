@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3>Booking: {{ $room->name }}</h3>

    <form method="POST" action="{{ route('booking.store') }}">
        @csrf
        <input type="hidden" name="room_id" value="{{ $room->id }}">

        <div class="mb-3">
            <label>Guest name</label>
            <input type="text" name="guest_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Persons</label>
            <input type="number" name="quantity" class="form-control" min="1" value="1">
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Check-in</label>
                <input type="date" name="check_in" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Check-out</label>
                <input type="date" name="check_out" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label>Note</label>
            <textarea name="note" class="form-control"></textarea>
        </div>

        <button class="btn btn-dark">Confirm Booking</button>
    </form>
</div>
@endsection