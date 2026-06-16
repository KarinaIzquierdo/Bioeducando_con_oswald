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
        Schema::table('proyecto_steams', function (Blueprint $table) {
            $table->text('objetivos')->nullable()->after('descripcion');
            $table->text('materiales')->nullable()->after('objetivos');
            $table->text('impacto_ambiental')->nullable()->after('materiales');
            $table->enum('estado', ['pendiente', 'aprobado', 'rechazado'])->default('aprobado')->after('imagen');
            $table->boolean('destacado')->default(false)->after('estado');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade')->after('destacado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proyecto_steams', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['objetivos', 'materiales', 'impacto_ambiental', 'estado', 'destacado', 'user_id']);
        });
    }
};
