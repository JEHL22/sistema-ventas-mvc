<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    /**
     * $fillable define los campos permitidos para guardar datos masivamente en la tabla 'materials'.
     */
    protected $fillable = [
        'descripcion',
        'tipo',
        'stock_total',
        'costo_unitario',
        'unidad_medida'
    ];

    /**
     * RELACIÓN: Un Material puede estar en muchos Escandallos (BOM).
     * El modelo de Escandallo usa 'material_id' para referirse a esta tabla.
     */
    public function escandallos()
    {
        return $this->hasMany(Escandallo::class , 'material_id');
    }
}