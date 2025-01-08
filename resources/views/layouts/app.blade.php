<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <!-- Fejléc -->
        <nav class="navbar navbar-expand-lg navbar-light bg-success shadow-sm py-3">
            <div class="container">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="navbar-brand text-light fs-3 fw-bold">
                    PiciPiac
                </a>

                <!-- Hamburger Menü -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navigációs elemek -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <!-- Keresősáv -->
                    <form method="GET" action="{{ route('products.index') }}" class="d-flex flex-column flex-lg-row w-100 mb-2 mb-lg-0">
                        <div class="d-flex w-100">
                            <select name="category" class="form-select me-3 mb-2 mb-lg-0">
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
                            <input type="text" name="search" class="form-control me-3 mb-2 mb-lg-0" placeholder="Termékek keresése">
                        </div>
                        <button class="btn btn-primary me-lg-4">Keresés</button>
                    </form>

                    <!-- Felhasználói opciók -->
                    <ul class="navbar-nav ms-auto align-items-center">
                        @guest
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="btn btn-secondary me-3">Bejelentkezés</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="btn btn-primary me-3">Regisztráció</a>
                            </li>
                        @else
                            <!-- Hirdetésfeladás gomb -->
                            <li class="nav-item">
                                <a href="{{ route('products.create') }}" class="btn btn-warning me-3 ms-lg-4">Hirdetésfeladás</a>
                            </li>

                            <!-- Kosár ikon -->
                            <li class="nav-item me-3">
                                <a href="{{ route('cart.index') }}" class="text-light fs-4">
                                    <i class="bi bi-cart"></i>
                                </a>
                            </li>

                            <!-- Felhasználói menü ikon -->
                            <li class="nav-item dropdown">
                                <a class="btn btn-secondary dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-circle"></i> <!-- Csak ikon jelenik meg -->
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profilom</a></li>
                                    <li><a class="dropdown-item" href="{{ route('order.history') }}">Rendeléseim</a></li>
                                    <li><a class="dropdown-item" href="{{ route('ads.index') }}">Hirdetéseim</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Kijelentkezés</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Kategóriák -->
        <div class="bg-light py-2">
            <div class="container">
                <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 g-2">
                    <a href="{{ route('products.index', ['category' => 'gyumolcsok']) }}" class="col text-secondary">Gyümölcsök</a>
                    <a href="{{ route('products.index', ['category' => 'zoldsegek']) }}" class="col text-secondary">Zöldségek</a>
                    <a href="{{ route('products.index', ['category' => 'tejtermekek']) }}" class="col text-secondary">Tejtermékek</a>
                    <a href="{{ route('products.index', ['category' => 'hus-es-huskeszitmenyek']) }}" class="col text-secondary">Húsok és húskészítmények</a>
                    <a href="{{ route('products.index', ['category' => 'mezek-es-lekvarok']) }}" class="col text-secondary">Mézek és lekvárok</a>
                    <a href="{{ route('products.index', ['category' => 'pekaruk']) }}" class="col text-secondary">Pékáruk</a>
                    <a href="{{ route('products.index', ['category' => 'fuszerek-es-gyogynovenyek']) }}" class="col text-secondary">Fűszerek és gyógynövények</a>
                    <a href="{{ route('products.index', ['category' => 'kezmuves-termekek']) }}" class="col text-secondary">Kézműves termékek</a>
                </div>
            </div>
        </div>

        <!-- Fő tartalom -->
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
