<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    /**
     * ATRIBUTO OBLIGATORIO: $fillable
     * Le decimos a Laravel qué campos pueden asignarse de forma masiva 
     * (ej. cuando usamos Cliente::create($request->all())).
     * Esto nos protege de "asignación masiva" maliciosa.
     */
    protected $fillable = [
        'nombre',
        'ruc',
        'galeria_tienda',
        'celular_whatsapp',
        'historial_pagos'
    ];

    /**
     * RELACIÓN: Un Cliente tiene muchas (hasMany) Órdenes de Trabajo.
     * Esto significa que en la DDBB, la tabla orden_trabajos tiene un cliente_id.
     * Gracias a esta función podremos hacer: $cliente->ordenesTrabajo
     */
    public function ordenesTrabajo()
    {
        return $this->hasMany(OrdenTrabajo::class , 'cliente_id');
    }
}