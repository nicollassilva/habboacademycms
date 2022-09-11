<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - @yield('title', 'Página')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="shortcut icon" href="/favicon.png" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" data-turbolinks-track="true">
    @stack('styles')

    <script src="https://polyfill.io/v3/polyfill.min.js"></script>
    <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" data-turbolinks-track="false" defer></script>
    @stack('scripts')
</head>
<body>
    <div class="container-fluid p-0">
        <main>
            @include('habboacademy.layouts.menu')
            <header class="customTransition">

                <div class="container">
                    <div class="logo"></div>
                </div>
            </header>

        <main id="app">
            @yield('content')
        </main>
    </main>
</div>
@if (config('app.env') == 'local')
<script src="http://localhost:35729/livereload.js"></script>
@endif
</body>
</html>
