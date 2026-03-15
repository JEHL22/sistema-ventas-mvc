<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('produccion_diarias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orden_trabajo_id')->constrained('orden_trabajos')->onDelete('cascade');
            $table->date('fecha');
            $table->string('operario_nombre');
            $table->integer('piezas_terminadas');
            $table->decimal('tiempo_empleado', 8, 2); // En horas o minutos según prefieras
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produccion_diarias');
    }
};