<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdenTrabajo extends Model
{
    /**
     * $fillable define los datos que guardaremos masivamente para crear una orden.
     */
    protected $fillable = [
        'cliente_id',
        'estilo_id',
        'cantidad_lote',
        'fecha_ingreso',
        'fecha_compromiso',
        'estado_actual' // Enum: Corte, Costura, Acabado, Entregado
    ];

    /**
     * RELACIÓN: Una Orden pertenece a un Cliente.
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class , 'cliente_id');
    }

    /**
     * RELACIÓN: Una Orden pertenece a un Estilo.
     */
    public function estilo()
    {
        return $this->belongsTo(Estilo::class , 'estilo_id');
    }

    /**
     * RELACIÓN: Una Orden tiene muchas Producciones Diarias registradas.
     * Esto será clave para ver qué operario trabajó en esta orden y en qué fecha.
     */
    public function produccionDiarias()
    {
        return $this->hasMany(ProduccionDiaria::class , 'orden_trabajo_id');
    }
}