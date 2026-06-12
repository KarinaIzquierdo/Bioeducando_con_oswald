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
        Schema::create('proyecto_praes', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('institucion');
            $table->text('descripcion');
            $table->string('imagen')->nullable();
            $table->string('archivo_pdf')->nullable(); // Para el documento del proyecto
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyecto_praes');
    }
};
