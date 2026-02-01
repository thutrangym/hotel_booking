@auth
@if(auth()->user()->role === 'admin')
@include('partials.header-admin')
@else
@include('partials.header-user')
@endif
@else
@include('partials.header-user')
@endauth