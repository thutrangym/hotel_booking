@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm rounded-4 border-0">
        <div class="card-body">
            <h4 class="fw-black mb-4">Create User</h4>

            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                {{-- Name --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Name</label>
                    <input type="text" name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}">
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Password</label>
                    <input type="password" name="password"
                        class="form-control @error('password') is-invalid @enderror">
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Confirm Password</label>
                    <input type="password" name="password_confirmation"
                        class="form-control">
                </div>

                {{-- Role --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Role</label>
                    <select name="role" class="form-select">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                {{-- Phone --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Phone</label>
                    <input type="text" name="phone" class="form-control"
                        value="{{ old('phone') }}">
                </div>

                {{-- Address --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Address</label>
                    <input type="text" name="address" class="form-control"
                        value="{{ old('address') }}">
                </div>

                {{-- DOB --}}
                <div class="mb-4">
                    <label class="form-label fw-bold">Date of Birth</label>
                    <input type="date" name="dob" class="form-control"
                        value="{{ old('dob') }}">
                </div>

                {{-- Actions --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                        Back
                    </a>
                    <button class="btn btn-dark fw-bold px-4">
                        Create
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection