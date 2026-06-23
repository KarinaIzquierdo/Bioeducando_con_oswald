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
        Schema::table('noticias', function (Blueprint $table) {
            $table->string('antetitulo')->nullable()->after('titulo');
            $table->text('subtitulo')->nullable()->after('antetitulo');
            $table->text('entradilla')->after('subtitulo');
            $table->longText('cuerpo')->after('entradilla');
            $table->string('pie_foto')->nullable()->after('imagen');
            $table->date('fecha_publicacion')->after('pie_foto');
            $table->string('categoria')->after('fecha_publicacion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('noticias', function (Blueprint $table) {
            //
        });
    }
};
