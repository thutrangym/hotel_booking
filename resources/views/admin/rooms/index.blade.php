@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between mb-3">
        <h3>Rooms</h3>
        <a href="{{ route('admin.rooms.create') }}" class="btn btn-dark">
            + Add Room
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Total</th>
                <th>Available</th>
                <th>Status</th>
                <th width="150">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rooms as $room)
            <tr>
                <td>
                    <a href="{{ route('admin.rooms.show', $room) }}"
                        class="fw-bold text-decoration-none text-dark">
                        {{ $room->name }}
                    </a>
                </td>

                <td>${{ $room->price }}</td>
                <td>{{ $room->total_rooms }}</td>
                <td>{{ $room->available_rooms }}</td>
                <td>{{ $room->status }}</td>
                <td>
                    <a href="{{ route('admin.rooms.edit', $room) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('admin.rooms.destroy', $room) }}"
                        method="POST"
                        class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger"
                            onclick="return confirm('Delete this room?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection