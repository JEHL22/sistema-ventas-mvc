<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('estilos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_estilo');
            $table->string('categoria');
            $table->string('foto_referencia')->nullable();
            $table->string('cod_molde')->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estilos');
    }
};