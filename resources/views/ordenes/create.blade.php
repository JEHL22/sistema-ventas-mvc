{{--
VISTA: ordenes/create.blade.php
Formulario para crear una nueva Orden de Trabajo.
Los datos de este formulario llegan al método store() del OrdenTrabajoController.
--}}
@extends('layouts.app')

@section('title', 'Nueva Orden de Trabajo')
@section('header', 'Nueva Orden de Trabajo')

@section('content')
<div class="mt-6 max-w-2xl">
    <div class="bg-gray-800 rounded-xl border border-gray-700 p-6">
        <p class="text-sm text-gray-400 mb-6">
            Completa los datos del pedido. El sistema calculará automáticamente la fecha de entrega
            usando los tiempos SAM del taller y verificará el stock disponible de materiales.
        </p>

        {{--
        @csrf: Genera un token de seguridad oculto que Laravel verifica para protegernos
        de ataques CSRF (Cross-Site Request Forgery). SIN ESTE, EL FORMULARIO NO FUNCIONARÁ.
        --}}
        <form action="{{ route('ordenes.store') }}" method="POST" class="space-y-5">
            @csrf

            {{-- CAMPO: Cliente --}}
            <div>
                <label for="cliente_id" class="block text-sm font-medium text-gray-300 mb-1">
                    Cliente
                </label>
                {{--
                old('cliente_id') recupera el valor anterior si hubo un error de validación,
                para que el usuario no pierda lo que ya escribió.
                --}}
                <select name="cliente_id" id="cliente_id" class="w-full bg-gray-900 border border-gray-600 rounded-lg px-3 py-2 text-white
                               focus:outline-none focus:ring-2 focus:ring-indigo-500
                               @error('cliente_id') border-red-500 @enderror">
                    <option value="">-- Selecciona un cliente --</option>
                    @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ old('cliente_id')==$cliente->id ? 'selected' : '' }}>
                        {{ $cliente->nombre }} ({{ $cliente->ruc ?? 'Sin RUC' }})
                    </option>
                    @endforeach
                </select>
                {{-- @error muestra el error de validación si existe para ese campo --}}
                @error('cliente_id')
                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- CAMPO: Estilo --}}
            <div>
                <label for="estilo_id" class="block text-sm font-medium text-gray-300 mb-1">
                    Estilo / Prenda
                </label>
                <select name="estilo_id" id="estilo_id" class="w-full bg-gray-900 border border-gray-600 rounded-lg px-3 py-2 text-white
                               focus:outline-none focus:ring-2 focus:ring-indigo-500
                               @error('estilo_id') border-red-500 @enderror">
                    <option value="">-- Selecciona un estilo --</option>
                    @foreach($estilos as $estilo)
                    <option value="{{ $estilo->id }}" {{ old('estilo_id')==$estilo->id ? 'selected' : '' }}>
                        {{ $estilo->nombre_estilo }} — {{ $estilo->categoria }} ({{ $estilo->cod_molde }})
                    </option>
                    @endforeach
                </select>
                @error('estilo_id')
                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- CAMPOS: Cantidad del lote y fecha de ingreso (en la misma fila) --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="cantidad_lote" class="block text-sm font-medium text-gray-300 mb-1">
                        Cantidad del Lote
                    </label>
                    <input type="number" name="cantidad_lote" id="cantidad_lote" value="{{ old('cantidad_lote') }}"
                        min="1" placeholder="Ej: 100" class="w-full bg-gray-900 border border-gray-600 rounded-lg px-3 py-2 text-white
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500
                                  @error('cantidad_lote') border-red-500 @enderror">
                    @error('cantidad_lote')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="fecha_ingreso" class="block text-sm font-medium text-gray-300 mb-1">
                        Fecha de Ingreso
                    </label>
                    <input type="date" name="fecha_ingreso" id="fecha_ingreso"
                        value="{{ old('fecha_ingreso', date('Y-m-d')) }}" class="w-full bg-gray-900 border border-gray-600 rounded-lg px-3 py-2 text-white
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500
                                  @error('fecha_ingreso') border-red-500 @enderror">
                    @error('fecha_ingreso')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Aviso sobre el cálculo automático --}}
            <div class="p-3 bg-indigo-900/30 border border-indigo-700/50 rounded-lg">
                <p class="text-xs text-indigo-300">
                    ⚡ La fecha de compromiso y la verificación de materiales se calcularán automáticamente
                    al guardar. Se notificará al cliente vía WhatsApp si hay déficit de stock.
                </p>
            </div>

            {{-- Botones --}}
            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="px-5 py-2 bg-indigo-600 hover:bg-indigo-500 text-white rounded-lg
                               text-sm font-medium transition-colors">
                    Crear Orden y Calcular →
                </button>
                <a href="{{ route('ordenes.index') }}" class="px-5 py-2 bg-gray-700 hover:bg-gray-600 text-gray-200 rounded-lg
                          text-sm font-medium transition-colors">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection