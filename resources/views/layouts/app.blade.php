<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Página') - {{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="shortcut icon" href="favicon.png" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')
</head>
<body>
    <div class="container-fluid p-0">
        <main>
            @include('habboacademy.layouts.menu')
        <header class="customTransition">
            <div class="top-bar">
                <div class="container">
                    <div class="last-registers">
                        <div class="default-title">
                            <b class="customTransition">Últimos</b>Registrados
                        </div>
                        <div class="latests-box">
                            @foreach (lastUsers() as $lastUser)
                                <a href="/profile/{{ $lastUser->username }}" class="latest-user"
                                    style="background-image: url('https://www.habbo.com.br/habbo-imaging/avatarimage?&user={{ $lastUser->username }}&action=std&direction=4&head_direction=3&img_format=png&gesture=std&headonly=1&size=s')"
                                    data-toggle="tooltip"
                                    title="<b>{{ $lastUser->username }}</b><br>Cadastrou {{ dateToString($lastUser->created_at) }}"
                                    data-placement="bottom"></a>
                            @endforeach
                        </div>
                    </div>
                    <div class="search-field">
                        <div class="default-title border-left-0">
                            <b class="customTransition">Pesquise</b>algo aqui
                        </div>
                        <div class="input customTransition">
                            <input type="text" name="search" autocomplete="off" placeholder="Pesquise por tópicos, notícias, etc">
                            <button><i class="fas fa-search fa-flip-horizontal"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            @auth
                <div class="container position-relative">
                    @include('habboacademy.layouts.user.menu')
                </div>
            @endauth
        </header>

        <main class="py-4">
            @yield('content')
        </main>
    </main>
</div>
<script src="{{ asset('js/fontawesome.min.js') }}"></script>
<script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
@yield('js')

@if (config('app.env') == 'local')
<script src="http://localhost:35729/livereload.js"></script>
@endif
</body>
</html>
