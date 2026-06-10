<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bioeducando con Oswald')</title>
    <!-- Tailwind CSS CDN para visualización rápida -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">
    <nav class="bg-green-700 p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center text-white font-bold">
            <a href="/" class="text-xl tracking-tight">Bioeducando con Oswald</a>
            <div class="space-x-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="hover:underline">Panel</a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button class="hover:underline">Salir</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:underline">Entrar</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="container mx-auto mt-8 p-4">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="mt-20 border-t border-gray-200 py-10 text-center text-gray-500 text-sm">
        &copy; {{ date('Y') }} Bioeducando con Oswald - Educación Ambiental
    </footer>
</body>
</html>
