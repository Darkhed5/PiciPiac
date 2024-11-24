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
</head>
<body>
    <div id="app">
        <!-- Fejléc -->
        <nav class="navbar navbar-light bg-light shadow-sm py-3">
            <div class="container d-flex justify-content-between align-items-center">
                <!-- Hirdetésfeladás gomb -->
                <a href="{{ route('products.create') }}" class="btn btn-primary">Hirdetésfeladás</a>

                <!-- Felhasználó menü -->
                @guest
                    <!-- Bejelentkezési link -->
                    <a href="{{ route('login') }}" class="btn btn-secondary">Bejelentkezés</a>
                @else
                    <!-- Dropdown menü -->
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                            <li>
                                <a class="dropdown-item" href="{{ route('order.history') }}">
                                    Rendelési előzményeim
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('ads.index') }}">
                                    Hirdetéseim
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
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
        </nav>

        <!-- Fő tartalom -->
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
