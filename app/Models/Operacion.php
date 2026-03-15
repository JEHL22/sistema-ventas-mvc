<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operacion extends Model
{
    /**
     * $fillable para la tabla operacions
     */
    protected $fillable = [
        'nombre',
        'maquina_clase',
        'tiempo_sam_minutos'
    ];

// Esta tabla es más un catálogo suelto que se podrá asociar luego
// a los estilos o a las órdenes mediante una tabla pivote si el proyecto crece.
}