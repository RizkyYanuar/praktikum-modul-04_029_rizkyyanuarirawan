<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MintonStore</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans antialiased text-gray-900 min-h-screen flex flex-col">

    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">

                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="text-xl font-bold text-indigo-600 tracking-wide">
                        MintonStore
                    </a>
                </div>

                <div class="flex items-center space-x-8">
                    <a href="{{ route('dashboard') }}"
                        class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium">Beranda</a>
                    <a href="{{ route('cart.index') }}"
                        class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium">Keranjang</a>
                    <a href="{{ route('orders.index') }}"
                        class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium">Pesanan Saya</a>
                </div>

                <div class="flex items-center space-x-4">
                    @auth
                        <div class="flex items-center gap-4">
                            <span class="text-sm text-gray-600 font-medium">
                                Halo, {{ Auth::user()->nama_lengkap ?? Auth::user()->username }}
                            </span>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-medium">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="flex items-center gap-4">
                            <a href="{{ route('login') }}"
                                class="text-sm text-gray-700 hover:text-indigo-600 font-medium">Login</a>
                            <a href="{{ route('register') }}"
                                class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-700">Register</a>
                        </div>
                    @endauth
                </div>

            </div>
        </div>
    </nav>

    @isset($header)
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                <h1 class="text-xl font-semibold text-gray-800">
                    {{ $header }}
                </h1>
            </div>
        </header>
    @endisset

    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                {{ session('error') }}
            </div>
        @endif

        {{ $slot ?? '' }}
        @yield('content')
    </main>

    <footer class="bg-white border-t border-gray-200 mt-auto">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} MintonStore. Made With ❤️ by Rizkyyy:>>
        </div>
    </footer>

</body>

</html>
