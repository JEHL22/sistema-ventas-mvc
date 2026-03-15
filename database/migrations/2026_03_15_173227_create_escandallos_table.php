<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('escandallos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estilo_id')->constrained('estilos')->onDelete('cascade');
            $table->foreignId('material_id')->constrained('materials')->onDelete('cascade');
            $table->decimal('cantidad_consumo', 8, 3);
            $table->decimal('porcentaje_merma', 5, 2);
            $table->decimal('largo_costura', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('escandallos');
    }
};