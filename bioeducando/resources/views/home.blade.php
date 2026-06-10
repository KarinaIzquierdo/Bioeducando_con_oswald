@extends('layouts.app')

@section('title', 'Bioeducando con Oswald - Inicio')

@section('content')
<div class="bg-green-50 min-h-[80vh]">
    <!-- Hero Section -->
    <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                <span class="block text-green-700">Bioeducando con Oswald</span>
                <span class="block text-gray-600 text-3xl mt-2">Transformando la educación ambiental</span>
            </h1>
            <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                Únete a nuestra comunidad para participar en retos ecológicos, ver contenido educativo y gestionar tus proyectos STEAM/PRAE.
            </p>
            <div class="mt-10 flex justify-center space-x-4">
                <a href="{{ route('login') }}" class="px-8 py-3 border border-transparent text-base font-bold rounded-md text-white bg-green-700 hover:bg-green-800 md:py-4 md:text-lg md:px-10 transition-all shadow-lg">
                    Iniciar Sesión
                </a>
                <a href="#modulos" class="px-8 py-3 border border-green-700 text-base font-bold rounded-md text-green-700 bg-white hover:bg-green-50 md:py-4 md:text-lg md:px-10 transition-all shadow-md">
                    Ver Módulos
                </a>
            </div>
        </div>
    </div>

    <!-- Módulos Informativos -->
    <div id="modulos" class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            <!-- STEAM/PRAE -->
            <div class="bg-white p-6 rounded-xl shadow-md border-b-4 border-green-600">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Proyectos STEAM/PRAE</h3>
                <p class="text-gray-600 italic">Gestión y seguimiento de proyectos ambientales escolares.</p>
            </div>
            <!-- Contenido -->
            <div class="bg-white p-6 rounded-xl shadow-md border-b-4 border-blue-600">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Educación Digital</h3>
                <p class="text-gray-600 italic">Podcasts, reels y videos educativos sobre el medio ambiente.</p>
            </div>
            <!-- Comunidad -->
            <div class="bg-white p-6 rounded-xl shadow-md border-b-4 border-yellow-600">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Retos y Comunidad</h3>
                <p class="text-gray-600 italic">Participa en retos ecológicos y comparte en el foro ambiental.</p>
            </div>
        </div>
    </div>
</div>
@endsection
