<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('operacions', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('maquina_clase');
            $table->decimal('tiempo_sam_minutos', 8, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('operacions');
    }
};