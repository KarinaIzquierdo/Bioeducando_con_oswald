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
        Schema::table('comentarios', function (Blueprint $table) {
            $table->foreignId('tema_discusion_id')->nullable()->change();
            $table->foreignId('publicacion_id')->nullable()->constrained()->onDelete('cascade');
            $table->renameColumn('body', 'contenido');
        });
    }

    public function down(): void
    {
        Schema::table('comentarios', function (Blueprint $table) {
            $table->renameColumn('contenido', 'body');
            $table->dropConstrainedForeignId('publicacion_id');
            $table->foreignId('tema_discusion_id')->nullable(false)->change();
        });
    }
};
