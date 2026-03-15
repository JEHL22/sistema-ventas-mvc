<!DOCTYPE html>
<html lang="es" class="h-full bg-gray-900">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- @yield('title') nos permite que CADA VISTA defina su propio título --}}
    <title>@yield('title', 'Sistema de Ventas') — ERP Confecciones</title>
    <meta name="description" content="Sistema de gestión de ventas y producción para talleres de confecciones.">

    {{-- Tailwind CSS y Vite: Vite es el bundler ultra-rápido que compila los assets CSS/JS.
    @vite() le dice a Laravel que use el pipeline de Vite para inyectar los archivos compilados.
    En desarrollo hace HMR (Hot Module Replacement) en tiempo real. --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full text-gray-100 antialiased">

    {{-- SIDEBAR DE NAVEGACIÓN --}}
    <div class="min-h-full flex">
        <aside class="w-64 bg-gray-800 border-r border-gray-700 flex flex-col">
            {{-- Logo / Marca --}}
            <div class="flex items-center gap-3 h-16 px-6 border-b border-gray-700">
                <div
                    class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center text-white font-bold text-sm">
                    ERP
                </div>
                <span class="font-semibold text-white tracking-wide text-sm">Confecciones MVC</span>
            </div>

            {{-- Menú de navegación --}}
            <nav class="flex-1 p-4 space-y-1">
                <a href="{{ route('ordenes.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium
                          {{ request()->routeIs('ordenes.*') ? 'bg-indigo-600 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}
                          transition-colors duration-150">
                    {{-- Ícono de portapapeles --}}
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Órdenes de Trabajo
                </a>
            </nav>

            {{-- Footer del sidebar --}}
            <div class="p-4 border-t border-gray-700">
                <p class="text-xs text-gray-500">v1.0 — ERP Confecciones</p>
            </div>
        </aside>

        {{-- CONTENIDO PRINCIPAL --}}
        <div class="flex-1 flex flex-col overflow-hidden">
            {{-- Barra superior --}}
            <header class="h-16 bg-gray-800 border-b border-gray-700 flex items-center px-6">
                <h1 class="text-base font-semibold text-white">
                    {{-- @yield('header') permite que cada vista inyecte su propio encabezado --}}
                    @yield('header', 'Dashboard')
                </h1>
            </header>

            {{-- Zona de mensajes flash (success/error) --}}
            <div class="px-6 pt-4">
                @if(session('success'))
                <div class="mb-4 p-4 rounded-lg bg-green-900/50 border border-green-700 text-green-300 text-sm">
                    {{ session('success') }}
                </div>
                @endif
                @if(session('error'))
                <div class="mb-4 p-4 rounded-lg bg-red-900/50 border border-red-700 text-red-300 text-sm">
                    {{ session('error') }}
                </div>
                @endif
            </div>

            {{-- @yield('content') es el "slot" donde cada vista inyectará su HTML --}}
            <main class="flex-1 overflow-y-auto px-6 pb-6">
                @yield('content')
            </main>
        </div>
    </div>

</body>

</html>