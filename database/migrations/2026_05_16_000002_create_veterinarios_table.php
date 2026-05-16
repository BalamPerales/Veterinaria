<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabla de veterinarios. Extiende un usuario del sistema.
     */
    public function up(): void
    {
        Schema::create('veterinarios', function (Blueprint $table) {
            $table->id();

            // FK → users
            $table->foreignId('usuario_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->string('nombre_completo');
            $table->string('especialidad')->nullable();
            $table->string('cedula_profesional', 100)->nullable();
            // URL externa de la imagen de firma
            $table->string('foto_firma')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('veterinarios');
    }
};
