<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <!-- Navigációs sáv -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-success py-3 shadow">
            <div class="container">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="navbar-brand text-white fw-bold">
                    PiciPiac
                </a>

                <!-- Keresősáv -->
                <form method="GET" action="{{ route('products.index') }}" class="d-flex w-50">
                    <select name="category" class="form-select me-2">
                        <option value="">Kategóriák</option>
                        <option value="gyumolcsok">Gyümölcsök</option>
                        <option value="zoldsegek">Zöldségek</option>
                        <option value="tejtermekek">Tejtermékek</option>
                        <option value="hus-es-huskeszitmenyek">Húsok és húskészítmények</option>
                        <option value="mezek-es-lekvarok">Mézek és lekvárok</option>
                        <option value="pekaruk">Pékáruk</option>
                        <option value="fuszerek-es-gyogynovenyek">Fűszerek és gyógynövények</option>
                        <option value="kezmuves-termekek">Kézműves termékek</option>
                    </select>
                    <input type="text" name="search" class="form-control me-2" placeholder="Keresés">
                    <button class="btn btn-light">Keresés</button>
                </form>

                <!-- Felhasználói opciók -->
                <div class="d-flex">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Bejelentkezés</a>
                        <a href="{{ route('register') }}" class="btn btn-outline-warning">Regisztráció</a>
                    @else
                        <a href="{{ route('products.create') }}" class="btn btn-warning me-2">Hirdetés feladása</a>
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('order.history') }}">Rendeléseim</a></li>
                                <li><a class="dropdown-item" href="{{ route('ads.index') }}">Hirdetéseim</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Kijelentkezés
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endguest
                </div>
            </div>
        </nav>

        <!-- Kategóriák szekció -->
        <div class="bg-light py-3">
            <div class="container d-flex justify-content-center flex-wrap gap-3">
                <a href="{{ route('products.index', ['category' => 'gyumolcsok']) }}" class="btn btn-outline-success">Gyümölcsök</a>
                <a href="{{ route('products.index', ['category' => 'zoldsegek']) }}" class="btn btn-outline-success">Zöldségek</a>
                <a href="{{ route('products.index', ['category' => 'tejtermekek']) }}" class="btn btn-outline-success">Tejtermékek</a>
                <a href="{{ route('products.index', ['category' => 'hus-es-huskeszitmenyek']) }}" class="btn btn-outline-success">Húsok</a>
                <a href="{{ route('products.index', ['category' => 'mezek-es-lekvarok']) }}" class="btn btn-outline-success">Mézek</a>
                <a href="{{ route('products.index', ['category' => 'pekaruk']) }}" class="btn btn-outline-success">Pékáruk</a>
                <a href="{{ route('products.index', ['category' => 'fuszerek-es-gyogynovenyek']) }}" class="btn btn-outline-success">Fűszerek</a>
                <a href="{{ route('products.index', ['category' => 'kezmuves-termekek']) }}" class="btn btn-outline-success">Kézműves termékek</a>
            </div>
        </div>

        <!-- Fő tartalom -->
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
