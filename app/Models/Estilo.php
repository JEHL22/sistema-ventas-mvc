<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estilo extends Model
{
    /**
     * Campos permitidos para guardar en la tabla 'estilos'
     */
    protected $fillable = [
        'nombre_estilo',
        'categoria',
        'foto_referencia',
        'cod_molde'
    ];

    /**
     * RELACIÓN: Un Estilo tiene muchos Escandallos (su receta de materiales).
     * Podremos usar $estilo->escandallos para listar todo lo que necesita.
     */
    public function escandallos()
    {
        return $this->hasMany(Escandallo::class , 'estilo_id');
    }

    /**
     * RELACIÓN: Un Estilo puede ser fabricado en muchas Órdenes de Trabajo.
     */
    public function ordenesTrabajo()
    {
        return $this->hasMany(OrdenTrabajo::class , 'estilo_id');
    }
}