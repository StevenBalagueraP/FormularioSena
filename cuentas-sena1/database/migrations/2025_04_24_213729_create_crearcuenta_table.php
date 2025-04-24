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
        Schema::create('crearcuenta', function (Blueprint $table) {
            $table->id(); // Campo ID autoincremental
            $table->string('juan'); // Cambia estos campos por los reales
            $table->string('valdez'); // Cambia estos campos por los reales
            $table->timestamps(); // Si necesitas timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crearcuenta');
    }
};
