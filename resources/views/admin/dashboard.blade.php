@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="fw-bold">Admin Dashboard</h1>

    <div class="alert alert-success mt-3">
        Welcome back, {{ auth()->user()->name }}
    </div>
</div>
@endsection