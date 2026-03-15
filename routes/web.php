<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdenTrabajoController;

/**
 * RUTAS WEB del Sistema de Ventas MVC
 * 
 * En Laravel, las rutas están en routes/web.php y son el "mapa" de la aplicación.
 * Route::resource() es un atajo poderoso que registra automáticamente 7 rutas:
 *   GET    /ordenes           → index   (listar)
 *   GET    /ordenes/create    → create  (formulario de creación)
 *   POST   /ordenes           → store   (guardar nueva)
 *   GET    /ordenes/{id}      → show    (ver detalle)
 *   GET    /ordenes/{id}/edit → edit    (formulario edición)
 *   PUT    /ordenes/{id}      → update  (actualizar)
 *   DELETE /ordenes/{id}      → destroy (eliminar)
 */

// Redirige el inicio al dashboard de órdenes
Route::get('/', function () {
    return redirect()->route('ordenes.index');
});

// Rutas CRUD para las Órdenes de Trabajo (generadas automáticamente por resource)
Route::resource('ordenes', OrdenTrabajoController::class)->parameters([
    'ordenes' => 'orden'
]);

// Ruta especial para actualizar el estado/etapa de una orden
Route::patch('ordenes/{orden}/estado', [OrdenTrabajoController::class , 'actualizarEstado'])
    ->name('ordenes.estado');