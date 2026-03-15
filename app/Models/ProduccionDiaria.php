<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProduccionDiaria extends Model
{
    /**
     * $fillable para registrar la producción
     */
    protected $fillable = [
        'orden_trabajo_id',
        'fecha',
        'operario_nombre',
        'piezas_terminadas',
        'tiempo_empleado'
    ];

    /**
     * RELACIÓN: Este registro de producción diaria pertenece a una Orden de Trabajo.
     */
    public function ordenTrabajo()
    {
        return $this->belongsTo(OrdenTrabajo::class , 'orden_trabajo_id');
    }
}