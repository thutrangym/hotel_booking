<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sunset Oasis')</title>

    {{-- CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Gidole&family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    {{-- Custom style --}}
    <style>
        * {
            font-family: 'Playfair Display', sans-serif;
        }

        .h-font {
            font-family: 'Gidole', sans-serif;
        }

        .custom-bg {
            background-color: #2ec1ac;
            border: 1px solid #2ec1ac;
        }

        .custom-bg:hover {
            background-color: #279e94;
            border-color: #279e94;
        }

        .availability-form {
            margin-top: -50px;
            z-index: 2;
            position: relative;
        }
    </style>

    @stack('styles')
</head>

<body class="bg-light">

    @include('partials.header')

    <main>
        @yield('content')
    </main>

    {{-- FOOTER (CHỈ USER) --}}
    @auth
    @if(auth()->user()->role !== 'admin')
    @include('partials.footer')
    @endif
    @else
    @include('partials.footer')
    @endauth

    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>

    @stack('scripts')
</body>

</html>