<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel - Welcome</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="container mx-auto px-6 py-4 flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-200">
                    Laravel
                </h1>
                @if (Route::has('login'))
                    <div>
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-800 dark:text-gray-200 hover:underline">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-800 dark:text-gray-200 hover:underline">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 text-gray-800 dark:text-gray-200 hover:underline">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-grow container mx-auto px-6 py-10">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">
                    Welcome to Laravel
                </h2>
                <p class="mt-4 text-gray-600 dark:text-gray-400">
                    Your Laravel application is ready to go. Start building your next project with ease.
                </p>
            </div>

            <!-- Links Section -->
            <div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                <a href="https://laravel.com/docs" class="block bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Documentation</h3>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        Laravel has wonderful documentation covering every aspect of the framework.
                    </p>
                </a>
                <a href="https://laracasts.com" class="block bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Laracasts</h3>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        Laracasts offers thousands of video tutorials on Laravel, PHP, and JavaScript.
                    </p>
                </a>
                <a href="https://laravel-news.com" class="block bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Laravel News</h3>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        Stay up-to-date with the latest news and updates in the Laravel ecosystem.
                    </p>
                </a>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-100 dark:bg-gray-800 py-4">
            <div class="container mx-auto text-center text-gray-600 dark:text-gray-400">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </div>
        </footer>
    </div>
</body>
</html>
