@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Edit Room</h3>

    <form method="POST"
        action="{{ route('admin.rooms.update', $room) }}"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Room name --}}
        <div class="mb-3">
            <label class="form-label">Room name</label>
            <input type="text"
                name="name"
                class="form-control"
                value="{{ old('name', $room->name) }}">
        </div>

        {{-- Price --}}
        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number"
                name="price"
                class="form-control"
                value="{{ old('price', $room->price) }}">
        </div>

        {{-- Size --}}
        <div class="mb-3">
            <label class="form-label">Size (m²)</label>
            <input type="number"
                name="size"
                class="form-control"
                value="{{ old('size', $room->size) }}">
        </div>

        {{-- Capacity --}}
        <div class="mb-3">
            <label class="form-label">Capacity</label>
            <input type="number"
                name="capacity"
                class="form-control"
                value="{{ old('capacity', $room->capacity) }}">
        </div>
        {{--Total rooms--}}
        <div class="mb-3">
            <label class="form-label">Total Rooms</label>
            <input type="number"
                name="total_rooms"
                class="form-control"
                value="{{ old('total_rooms', $room->total_rooms) }}">
        </div>
        {{--Available rooms--}}
        <div class="mb-3">
            <label class="form-label">Available Rooms</label>
            <input type="number"
                name="available_rooms"
                class="form-control"
                value="{{ old('available_rooms', $room->available_rooms) }}">
        </div>

        {{-- Description --}}
        <div class="mb-4">
            <label class="form-label">Description</label>
            <textarea name="description"
                class="form-control"
                rows="4">{{ old('description', $room->description) }}</textarea>
        </div>
        <select name="status" class="form-control mb-2">
            <option value="available" @selected($room->status === 'available')>Available</option>
            <option value="hidden" @selected($room->status === 'hidden')>Hidden</option>
        </select>


        {{-- Facilities --}}
        <div class="mb-4">
            <label class="form-label fw-bold">Facilities</label>
            <div class="row">
                @foreach($facilities as $facility)
                <div class="col-md-4 mb-2">
                    <label class="d-flex align-items-center gap-2">
                        <input type="checkbox"
                            name="facilities[]"
                            value="{{ $facility->id }}"
                            @checked($room->facilities->contains($facility->id))>

                        @if($facility->icon)
                        <img src="{{ asset('icons/'.$facility->icon) }}"
                            width="18"
                            height="18">
                        @endif

                        {{ $facility->name }}
                    </label>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Existing images --}}
        <div class="mb-4">
            <label class="form-label fw-bold">Current Images</label>
            <div class="d-flex flex-wrap gap-3">
                @forelse($room->images as $image)
                <img src="{{ asset('storage/'.$image->image_path) }}"
                    width="120"
                    class="rounded border">
                @empty
                <p class="text-muted">No images uploaded</p>
                @endforelse
            </div>
        </div>

        {{-- Upload new images --}}
        <div class="mb-4">
            <label class="form-label">Add new images</label>
            <input type="file"
                name="images[]"
                class="form-control"
                multiple>
            <small class="text-muted">
                You can upload multiple images. Old images will not be deleted.
            </small>
        </div>

        {{-- Submit --}}
        <button class="btn btn-dark">
            Update Room
        </button>
    </form>
</div>
@endsection