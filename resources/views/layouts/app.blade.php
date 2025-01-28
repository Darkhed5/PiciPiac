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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .category-bar {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #e6efe9;
            flex-wrap: wrap;
            gap: 10px; /* Távolság az ikonok között */
            margin: 0 auto;
            border-radius: 10px;
            padding: 15px;
        }

        .category-link {
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            color: #3b7f4b;
            font-size: 2.5rem; /* Ikon méret */
            width: 100px; /* Fix szélesség */
            height: 100px; /* Fix magasság */
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .category-link:hover {
            color: #028a0f;
            background-color: #c7e3d2;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .category-link {
                width: 80px; /* Kisebb ikonok mobilon */
                height: 80px;
                font-size: 2rem;
            }
        }

        @media (max-width: 480px) {
            .category-link {
                width: 70px; /* Még kisebb ikonok kis képernyőn */
                height: 70px;
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <div id="app">
        <!-- Fejléc -->
        <nav class="navbar navbar-expand-lg navbar-light bg-success shadow-sm py-3">
            <div class="container">
                <a href="{{ route('home') }}" class="navbar-brand text-light fs-3 fw-bold">
                    PiciPiac
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
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
                    <ul class="navbar-nav ms-auto align-items-center">
                        @guest
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="btn btn-secondary me-3">Bejelentkezés</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="btn btn-primary me-3">Regisztráció</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('products.create') }}" class="btn btn-warning me-3 ms-lg-4">Hirdetésfeladás</a>
                            </li>
                            <li class="nav-item me-3">
                                <a href="{{ route('cart.index') }}" class="text-light fs-4">
                                    <i class="bi bi-cart"></i>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="btn btn-secondary dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-circle"></i>
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
        <div class="category-bar">
            <a href="{{ route('products.index', ['category' => 'gyumolcsok']) }}" class="category-link">
                <i class="fas fa-apple-alt"></i>
            </a>
            <a href="{{ route('products.index', ['category' => 'zoldsegek']) }}" class="category-link">
                <i class="fas fa-carrot"></i>
            </a>
            <a href="{{ route('products.index', ['category' => 'tejtermekek']) }}" class="category-link">
                <i class="fas fa-cheese"></i>
            </a>
            <a href="{{ route('products.index', ['category' => 'hus-es-huskeszitmenyek']) }}" class="category-link">
                <i class="fas fa-drumstick-bite"></i>
            </a>
            <a href="{{ route('products.index', ['category' => 'mezek-es-lekvarok']) }}" class="category-link">
                <i class="fa-solid fa-face-grin-tongue"></i>
            </a>
            <a href="{{ route('products.index', ['category' => 'pekaruk']) }}" class="category-link">
                <i class="fas fa-bread-slice"></i>
            </a>
            <a href="{{ route('products.index', ['category' => 'fuszerek-es-gyogynovenyek']) }}" class="category-link">
                <i class="fas fa-leaf"></i>
            </a>
            <a href="{{ route('products.index', ['category' => 'kezmuves-termekek']) }}" class="category-link">
                <i class="fas fa-hand-holding-heart"></i>
            </a>
        </div>

        <!-- Fő tartalom -->
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
