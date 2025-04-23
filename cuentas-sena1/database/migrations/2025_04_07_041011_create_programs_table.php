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
        Schema::create('programs', function (Blueprint $table) {
            $table->id(); // ID único
            $table->string('denominacion'); // Denominación del Programa
            $table->string('codigo'); // Código del Programa
            $table->string('version'); // Versión del Programa
            $table->date('fecha_inicio'); // Fecha de Inicio
            $table->date('fecha_fin'); // Fecha de Fin
            $table->integer('etapa_lectiva'); // Duración de la Etapa Lectiva (horas)
            $table->integer('etapa_productiva'); // Duración de la Etapa Productiva (horas)
            $table->integer('duracion_total'); // Duración Total (horas)
            $table->string('titulo_certificado'); // Título o Certificado del Programa
            $table->text('justificacion'); // Justificación del Programa
            $table->string('sectores'); // Sectores del Programa
            $table->enum('modalidad', ['Presencial', 'Virtual', 'Mixta']); // Modalidad del Programa
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
