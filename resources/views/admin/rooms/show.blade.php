@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between mb-3">
        <h3>{{ $room->name }}</h3>
        <div>
            <a href="{{ route('admin.rooms.edit', $room) }}" class="btn btn-warning">
                Edit
            </a>
            <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">
                Back
            </a>
        </div>
    </div>

    {{-- BASIC INFO --}}
    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Price:</strong> ${{ $room->price }}</p>
            <p><strong>Size:</strong> {{ $room->size ?? '—' }} m²</p>
            <p><strong>Capacity:</strong> {{ $room->capacity ?? '—' }} people</p>
            <p><strong>Status:</strong>
                <span class="badge bg-{{ $room->status === 'available' ? 'success' : 'secondary' }}">
                    {{ ucfirst($room->status) }}
                </span>
            </p>
            <p><strong>Total rooms:</strong> {{ $room->total_rooms }}</p>
            <p><strong>Available rooms:</strong> {{ $room->available_rooms }}</p>
        </div>
    </div>

    {{-- DESCRIPTION --}}
    @if($room->description)
    <div class="card mb-4">
        <div class="card-header">Description</div>
        <div class="card-body">
            {{ $room->description }}
        </div>
    </div>
    @endif

    {{-- FACILITIES --}}
    {{-- Facilities --}}
    <div class="mb-4">
        <label class="form-label fw-bold">Facilities</label>

        @if($room->facilities->count())
        <div class="row">
            @foreach($room->facilities as $facility)
            <div class="col-md-4 mb-2">
                <div class="d-flex align-items-center gap-2">
                    @if($facility->icon)
                    <img src="{{ asset('icons/'.$facility->icon) }}"
                        width="18"
                        height="18">
                    @endif

                    <span>{{ $facility->name }}</span>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-muted">No facilities</p>
        @endif
    </div>


    {{-- IMAGES --}}
    <div class="card">
        <div class="card-header">Room Images</div>
        <div class="card-body">
            <div class="row">
                @forelse($room->images as $image)
                <div class="col-md-3 mb-3">
                    <img src="{{ asset('storage/'.$image->image_path) }}"
                        class="img-fluid rounded shadow-sm">
                </div>
                @empty
                <p class="text-muted">No images</p>
                @endforelse
            </div>
        </div>
    </div>

</div>
@endsection