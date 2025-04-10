<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('resultados', function (Blueprint $table) {
            $table->id('idResultado');
            $table->unsignedBigInteger('competencia_id');
            $table->string('nombreResultado');
            $table->timestamps();

            // Relación con competencias
            $table->foreign('competencia_id')
                ->references('id')->on('competencias')
                ->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultados');
    }
};
