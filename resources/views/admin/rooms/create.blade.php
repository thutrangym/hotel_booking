@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            {{-- Header --}}
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h2 className="fw-black text-dark mb-1">Add New Room</h2>
                    <p className="text-muted">Fill in the details to list a new room in your system.</p>
                </div>
                <a href="{{ route('admin.rooms.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-2"></i>Back to List
                </a>
            </div>

            <form method="POST" action="{{ route('admin.rooms.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">
                    {{-- Cột trái: Thông tin chính --}}
                    <div class="col-md-8">
                        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                            <h5 class="fw-bold mb-4 text-primary">General Information</h5>

                            <div class="mb-3">
                                <label class="form-label fw-bold small text-uppercase tracking-wider">Room Name</label>
                                <input name="name" class="form-control form-control-lg bg-light border-0 rounded-3" placeholder="e.g. Deluxe Ocean View">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small text-uppercase tracking-wider">Description</label>
                                <textarea name="description" class="form-control bg-light border-0 rounded-3" rows="5" placeholder="Describe the room features, view, etc."></textarea>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-uppercase tracking-wider">Price (per night)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0">$</span>
                                        <input name="price" type="number" class="form-control bg-light border-0 rounded-end-3" placeholder="0.00">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-uppercase tracking-wider">Room Size (m²)</label>
                                    <input name="size" type="number" class="form-control bg-light border-0 rounded-3" placeholder="e.g. 35">
                                </div>
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <h5 class="fw-bold mb-4 text-primary">Facilities</h5>
                            <div class="row g-3">
                                @foreach ($facilities as $facility)
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            name="facilities[]"
                                            value="{{ $facility->id }}"
                                            id="facility_{{ $facility->id }}">
                                        <label class="form-check-label" for="facility_{{ $facility->id }}">
                                            <img
                                                src="{{ asset('icons/' . $facility->icon) }}"
                                                width="20"
                                                class="me-1">
                                            {{ $facility->name }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Cột phải: Thông số & Hình ảnh --}}
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                            <h5 class="fw-bold mb-4 text-primary">Inventory & Status</h5>

                            <div class="mb-3">
                                <label class="form-label fw-bold small text-uppercase tracking-wider">Status</label>
                                <select name="status" class="form-select bg-light border-0 rounded-3">
                                    <option value="available">🟢 Available</option>
                                    <option value="hidden">🟡 Hidden</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small text-uppercase tracking-wider">Capacity (Persons)</label>
                                <input name="capacity" type="number" class="form-control bg-light border-0 rounded-3" placeholder="e.g. 2">
                            </div>

                            <div class="row g-2">
                                <div class="col-6">
                                    <label class="form-label fw-bold small text-uppercase tracking-wider">Total</label>
                                    <input name="total_rooms" type="number" class="form-control bg-light border-0 rounded-3" placeholder="10">
                                </div>
                                <div class="col-6">
                                    <label class="form-label fw-bold small text-uppercase tracking-wider">Available</label>
                                    <input name="available_rooms" type="number" class="form-control bg-light border-0 rounded-3" placeholder="10">
                                </div>
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                            <h5 class="fw-bold mb-4 text-primary">Room Images</h5>
                            <div class="upload-zone py-4 border-2 border-dashed border-light-subtle rounded-4 text-center bg-light/50">
                                <i class="bi bi-cloud-arrow-up fs-2 text-muted"></i>
                                <p class="small text-muted mt-2">Upload multiple images</p>
                                <input type="file" name="images[]" multiple class="form-control form-control-sm">
                            </div>
                        </div>

                        <button class="btn btn-dark w-100 py-3 rounded-4 fw-bold shadow-lg mt-2 transition-all hover-scale">
                            Save Room Details
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .fw-black {
        font-weight: 900;
    }

    .bg-light {
        background-color: #f8f9fa !important;
    }

    .rounded-4 {
        border-radius: 1rem !important;
    }

    .form-control:focus,
    .form-select:focus {
        background-color: #fff !important;
        box-shadow: 0 0 0 4px rgba(52, 219, 197, 0.1);
        border-color: #34DBC5;
    }

    .custom-card-check {
        padding: 10px;
        border-radius: 10px;
        transition: all 0.2s;
        border: 1px solid transparent;
    }

    .custom-card-check:hover {
        background: #f1f3f5;
    }

    .hover-scale:active {
        transform: scale(0.98);
    }
</style>
@endsection