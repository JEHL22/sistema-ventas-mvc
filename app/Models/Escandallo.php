<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Escandallo extends Model
{
    /**
     * $fillable para la tabla escandallos.
     */
    protected $fillable = [
        'estilo_id',
        'material_id',
        'cantidad_consumo',
        'porcentaje_merma',
        'largo_costura'
    ];

    /**
     * RELACIÓN: Un registro de Escandallo "pertenece a" (belongsTo) un Estilo.
     * Laravel asume por defecto que la llave foránea se llama 'estilo_id'.
     */
    public function estilo()
    {
        return $this->belongsTo(Estilo::class , 'estilo_id');
    }

    /**
     * RELACIÓN: Un registro de Escandallo "pertenece a" (belongsTo) un Material.
     * Con esto podemos hacer: echo $escandallo->material->descripcion;
     */
    public function material()
    {
        return $this->belongsTo(Material::class , 'material_id');
    }
}