<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cargarmasivos', function (Blueprint $table) {
            $table->id(); // Columna ID primaria
            $table->string('campo1'); // Cambia 'campo1' por el nombre real de la columna
            $table->string('campo2')->nullable(); // Cambia 'campo2' por el nombre real de la columna
            $table->timestamps(); // Agrega columnas created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cargarmasivos');
    }
};
