<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orden_trabajos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('estilo_id')->constrained('estilos')->onDelete('cascade');
            $table->integer('cantidad_lote');
            $table->date('fecha_ingreso');
            $table->date('fecha_compromiso');
            $table->enum('estado_actual', ['Corte', 'Costura', 'Acabado', 'Entregado'])->default('Corte');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orden_trabajos');
    }
};