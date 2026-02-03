@extends('layouts.app')

@section('content')
<div class="container mt-5" style="max-width: 700px">
    <h3 class="mb-4">My Profile</h3>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Avatar --}}
        <div class="mb-3">
            <label>Avatar</label><br>
            @if($user->avatar)
            <img src="{{ asset('storage/'.$user->avatar) }}"
                width="80"
                class="mb-2 rounded-circle">
            @endif
            <input type="file" name="avatar" class="form-control">
        </div>

        {{-- Name --}}
        <div class="mb-3">
            <label>Name</label>
            <input name="name" class="form-control" value="{{ old('name', $user->name) }}">
        </div>

        {{-- Phone --}}
        <div class="mb-3">
            <label>Phone</label>
            <input name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
        </div>

        {{-- Address --}}
        <div class="mb-3">
            <label>Address</label>
            <input name="address" class="form-control" value="{{ old('address', $user->address) }}">
        </div>

        {{-- DOB --}}
        <div class="mb-3">
            <label>Date of Birth</label>
            <input type="date" name="dob" class="form-control"
                value="{{ old('dob', $user->dob) }}">
        </div>

        <hr>

        {{-- Password --}}
        <div class="mb-3">
            <label>New Password (optional)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button class="btn btn-dark">Update Profile</button>
    </form>
</div>
@endsection