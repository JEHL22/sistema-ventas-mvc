{{--
VISTA: ordenes/show.blade.php
Muestra el detalle completo de una Orden de Trabajo:
- Panel de información general
- Explosión de materiales usados (del escandallo)
- Producción diaria registrada
- Formulario para cambiar de etapa
--}}
@extends('layouts.app')

@section('title', 'Orden #' . $orden->id)
@section('header', 'Orden de Trabajo #' . $orden->id . ' — ' . $orden->cliente->nombre)

@section('content')
<div class="mt-6 space-y-6">

    {{-- === PANEL SUPERIOR: Información de la Orden === --}}
    <div class="grid grid-cols-3 gap-4">

        {{-- Info general --}}
        <div class="col-span-2 bg-gray-800 rounded-xl border border-gray-700 p-5">
            <h2 class="text-sm font-semibold text-gray-300 uppercase tracking-wider mb-4">Información del Pedido</h2>
            <dl class="grid grid-cols-2 gap-x-6 gap-y-3 text-sm">
                <div>
                    <dt class="text-gray-500">Cliente</dt>
                    <dd class="text-white font-medium">{{ $orden->cliente->nombre }}</dd>
                </div>
                <div>
                    <dt class="text-gray-500">WhatsApp</dt>
                    <dd class="text-white">{{ $orden->cliente->celular_whatsapp }}</dd>
                </div>
                <div>
                    <dt class="text-gray-500">Estilo</dt>
                    <dd class="text-white font-medium">{{ $orden->estilo->nombre_estilo }}</dd>
                </div>
                <div>
                    <dt class="text-gray-500">Código de Molde</dt>
                    <dd class="font-mono text-indigo-300">{{ $orden->estilo->cod_molde }}</dd>
                </div>
                <div>
                    <dt class="text-gray-500">Cantidad Lote</dt>
                    <dd class="text-white font-bold text-lg">{{ number_format($orden->cantidad_lote) }} uds.</dd>
                </div>
                <div>
                    <dt class="text-gray-500">Categoría</dt>
                    <dd class="text-gray-300">{{ $orden->estilo->categoria }}</dd>
                </div>
                <div>
                    <dt class="text-gray-500">Fecha Ingreso</dt>
                    <dd class="text-gray-300">{{ $orden->fecha_ingreso }}</dd>
                </div>
                <div>
                    <dt class="text-gray-500">Fecha Compromiso (SAM)</dt>
                    <dd class="text-yellow-300 font-medium">{{ $orden->fecha_compromiso }}</dd>
                </div>
            </dl>
        </div>

        {{-- Estado actual + Cambiar estado --}}
        <div class="bg-gray-800 rounded-xl border border-gray-700 p-5 flex flex-col justify-between">
            <div>
                <h2 class="text-sm font-semibold text-gray-300 uppercase tracking-wider mb-3">Estado Actual</h2>
                @php
                $badge = match($orden->estado_actual) {
                'Corte' => 'bg-yellow-900/60 text-yellow-300 border-yellow-700',
                'Costura' => 'bg-blue-900/60 text-blue-300 border-blue-700',
                'Acabado' => 'bg-purple-900/60 text-purple-300 border-purple-700',
                'Entregado' => 'bg-green-900/60 text-green-300 border-green-700',
                default => 'bg-gray-700 text-gray-300',
                };
                @endphp
                <span class="inline-block px-3 py-1.5 rounded-full text-sm font-semibold border {{ $badge }}">
                    {{ $orden->estado_actual }}
                </span>
            </div>

            {{-- Formulario para avanzar el estado --}}
            <form action="{{ route('ordenes.estado', $orden) }}" method="POST" class="mt-4">
                @csrf
                {{-- @method('PATCH') indica a Laravel que esta es una petición PATCH
                (ya que HTML solo soporta GET y POST, Laravel intercepta el campo oculto). --}}
                @method('PATCH')
                <label class="block text-xs text-gray-500 mb-1">Avanzar a etapa</label>
                <div class="flex gap-2">
                    <select name="estado_actual" class="flex-1 bg-gray-900 border border-gray-600 rounded-lg px-2 py-1.5
                                   text-sm text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="Corte" {{ $orden->estado_actual == 'Corte' ? 'selected' : '' }}>Corte</option>
                        <option value="Costura" {{ $orden->estado_actual == 'Costura' ? 'selected' : '' }}>Costura
                        </option>
                        <option value="Acabado" {{ $orden->estado_actual == 'Acabado' ? 'selected' : '' }}>Acabado
                        </option>
                        <option value="Entregado" {{ $orden->estado_actual == 'Entregado'? 'selected' : '' }}>Entregado
                        </option>
                    </select>
                    <button type="submit" class="px-3 py-1.5 bg-indigo-600 hover:bg-indigo-500 text-white
                                   text-xs rounded-lg transition-colors">
                        Actualizar
                    </button>
                </div>
                <p class="mt-1 text-xs text-gray-500">Se notificará al cliente vía WhatsApp. 📱</p>
            </form>
        </div>
    </div>

    {{-- === SECCIÓN: Explosión de Materiales (BOM / Escandallo) === --}}
    <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-700">
            <h2 class="text-sm font-semibold text-gray-300 uppercase tracking-wider">
                Explosión de Materiales — Escandallo de {{ $orden->estilo->nombre_estilo }}
            </h2>
        </div>
        <table class="w-full text-sm">
            <thead class="bg-gray-900/50 text-gray-400 text-xs uppercase">
                <tr>
                    <th class="px-4 py-3 text-left">Material</th>
                    <th class="px-4 py-3 text-right">Consumo/Prenda</th>
                    <th class="px-4 py-3 text-right">Merma %</th>
                    <th class="px-4 py-3 text-right">Total Requerido</th>
                    <th class="px-4 py-3 text-right">Stock Actual</th>
                    <th class="px-4 py-3 text-center">Estado</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                {{--
                $orden->estilo->escandallos fue cargado con eager loading en el controlador.
                Iteramos y calculamos el requerimiento total en la vista.
                --}}
                @forelse($orden->estilo->escandallos as $esc)
                @php
                $mermaFactor = 1 + ($esc->porcentaje_merma / 100);
                $totalReq = round($orden->cantidad_lote * $esc->cantidad_consumo * $mermaFactor, 3);
                $stockActual = $esc->material->stock_total;
                $hayStock = $stockActual >= $totalReq;
                @endphp
                <tr>
                    <td class="px-4 py-3 font-medium">{{ $esc->material->descripcion }}</td>
                    <td class="px-4 py-3 text-right font-mono text-gray-300">
                        {{ $esc->cantidad_consumo }} {{ $esc->material->unidad_medida }}
                    </td>
                    <td class="px-4 py-3 text-right text-gray-400">{{ $esc->porcentaje_merma }}%</td>
                    <td class="px-4 py-3 text-right font-mono font-semibold">
                        {{ $totalReq }} {{ $esc->material->unidad_medida }}
                    </td>
                    <td class="px-4 py-3 text-right font-mono {{ $hayStock ? 'text-green-300' : 'text-red-400' }}">
                        {{ $stockActual }}
                    </td>
                    <td class="px-4 py-3 text-center">
                        @if($hayStock)
                        <span
                            class="text-xs px-2 py-0.5 bg-green-900/50 text-green-300 rounded-full border border-green-700">✓
                            OK</span>
                        @else
                        <span
                            class="text-xs px-2 py-0.5 bg-red-900/50 text-red-300 rounded-full border border-red-700">⚠
                            Déficit</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-6 text-center text-gray-500 text-xs">
                        Este estilo no tiene escandallo (BOM) configurado.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- === SECCIÓN: Producción Diaria === --}}
    <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-700">
            <h2 class="text-sm font-semibold text-gray-300 uppercase tracking-wider">Producción Diaria Registrada</h2>
        </div>
        <table class="w-full text-sm">
            <thead class="bg-gray-900/50 text-gray-400 text-xs uppercase">
                <tr>
                    <th class="px-4 py-3 text-left">Fecha</th>
                    <th class="px-4 py-3 text-left">Operario</th>
                    <th class="px-4 py-3 text-right">Piezas Terminadas</th>
                    <th class="px-4 py-3 text-right">Tiempo Empleado</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @forelse($orden->produccionDiarias as $prod)
                <tr>
                    <td class="px-4 py-3 text-gray-400">{{ $prod->fecha }}</td>
                    <td class="px-4 py-3 font-medium">{{ $prod->operario_nombre }}</td>
                    <td class="px-4 py-3 text-right font-mono text-white">{{ number_format($prod->piezas_terminadas) }}
                    </td>
                    <td class="px-4 py-3 text-right text-gray-300">{{ $prod->tiempo_empleado }} min</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-6 text-center text-gray-500 text-xs">
                        No hay producción diaria registrada para esta orden aún.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Volver al listado --}}
    <a href="{{ route('ordenes.index') }}" class="inline-block text-sm text-indigo-400 hover:text-indigo-300">
        ← Volver al listado
    </a>

</div>
@endsection