{{--
VISTAS BLADE: ordenes/index.blade.php

@extends significa: "Esta vista hereda (extiende) el layout base llamado 'layouts.app'".
Laravel buscará el archivo resources/views/layouts/app.blade.php y lo usará como contenedor.

@section define los bloques de contenido que el layout insertará donde tenga @yield().
--}}
@extends('layouts.app')

@section('title', 'Órdenes de Trabajo')
@section('header', 'Órdenes de Trabajo')

@section('content')
<div class="mt-6">
    {{-- Cabecera con título y botón de nueva orden --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-sm text-gray-400">Gestión completa de producción</p>
        </div>
        {{-- route('ordenes.create') genera la URL /ordenes/create automáticamente --}}
        <a href="{{ route('ordenes.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-500
                  text-white text-sm font-medium rounded-lg transition-colors duration-150">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Nueva Orden
        </a>
    </div>

    {{-- Tarjetas de estadísticas --}}
    <div class="grid grid-cols-4 gap-4 mb-8">
        @foreach([
        ['Corte', 'bg-yellow-500', 'text-yellow-300'],
        ['Costura', 'bg-blue-500', 'text-blue-300'],
        ['Acabado', 'bg-purple-500', 'text-purple-300'],
        ['Entregado','bg-green-500', 'text-green-300'],
        ] as [$estado, $bg, $text])
        {{--
        $ordenes->getCollection() obtiene solo los registros de la página actual.
        filter() es un método de las Collections de Laravel que filtra los elementos.
        count() cuenta cuántos quedan después del filtro.
        --}}
        @php $count = $ordenes->getCollection()->where('estado_actual', $estado)->count(); @endphp
        <div class="bg-gray-800 rounded-xl p-4 border border-gray-700">
            <p class="text-xs text-gray-400 uppercase tracking-wide">{{ $estado }}</p>
            <p class="text-3xl font-bold mt-1 {{ $text }}">{{ $count }}</p>
        </div>
        @endforeach
    </div>

    {{-- Tabla de órdenes --}}
    <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-900/50 text-gray-400 uppercase text-xs tracking-wider">
                <tr>
                    <th class="px-4 py-3 text-left">#</th>
                    <th class="px-4 py-3 text-left">Cliente</th>
                    <th class="px-4 py-3 text-left">Estilo</th>
                    <th class="px-4 py-3 text-right">Lote</th>
                    <th class="px-4 py-3 text-left">Ingreso</th>
                    <th class="px-4 py-3 text-left">Compromiso</th>
                    <th class="px-4 py-3 text-center">Estado</th>
                    <th class="px-4 py-3 text-center">Acción</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                {{--
                @forelse es como @foreach pero tiene un @empty para cuando no hay datos.
                Cada $orden viene con sus relaciones precargadas (cliente, estilo) gracias
                al with() que hicimos en el Controlador.
                --}}
                @forelse($ordenes as $orden)
                <tr class="hover:bg-gray-750 transition-colors">
                    <td class="px-4 py-3 text-gray-400">{{ $orden->id }}</td>
                    <td class="px-4 py-3 font-medium">{{ $orden->cliente->nombre }}</td>
                    <td class="px-4 py-3 text-gray-300">{{ $orden->estilo->nombre_estilo }}</td>
                    <td class="px-4 py-3 text-right font-mono">{{ number_format($orden->cantidad_lote) }}</td>
                    <td class="px-4 py-3 text-gray-400">{{ $orden->fecha_ingreso }}</td>
                    <td class="px-4 py-3 text-gray-400">{{ $orden->fecha_compromiso }}</td>
                    <td class="px-4 py-3 text-center">
                        {{-- Badge de estado con colores semánticos --}}
                        @php
                        $badge = match($orden->estado_actual) {
                        'Corte' => 'bg-yellow-900/60 text-yellow-300 border-yellow-700',
                        'Costura' => 'bg-blue-900/60 text-blue-300 border-blue-700',
                        'Acabado' => 'bg-purple-900/60 text-purple-300 border-purple-700',
                        'Entregado' => 'bg-green-900/60 text-green-300 border-green-700',
                        default => 'bg-gray-700 text-gray-300',
                        };
                        @endphp
                        <span class="px-2 py-1 rounded-full text-xs font-medium border {{ $badge }}">
                            {{ $orden->estado_actual }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-center">
                        <a href="{{ route('ordenes.show', $orden) }}"
                            class="text-indigo-400 hover:text-indigo-300 text-xs font-medium transition-colors">
                            Ver detalle →
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-4 py-12 text-center text-gray-500">
                        No hay órdenes registradas aún.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación (generada automáticamente por Laravel con ->paginate()) --}}
    <div class="mt-4">
        {{ $ordenes->links() }}
    </div>
</div>
@endsection