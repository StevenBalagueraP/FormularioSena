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
        Schema::create('file', function (Blueprint $table) {
            $table->id();
            $table->string('numero_ficha',20)->nullable();
            $table->string('instructor_lider');
            $table->enum('jornada',['Mañana', 'Tarde', 'Noche', 'Mixta']);
            $table->string('horario');
            $table->string('ambiente');
            $table->string('dias_formacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_file');
    }
};
