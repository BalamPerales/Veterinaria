<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabla de consultas veterinarias.
     * Relaciona mascotas ↔ veterinarios.
     */
    public function up(): void
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();

            // FK → mascotas (cascade: si se borra la mascota, se borran sus consultas)
            $table->foreignId('mascota_id')
                  ->constrained('mascotas')
                  ->onDelete('cascade');

            // FK → veterinarios (restrict: no borrar un vet con consultas activas)
            $table->foreignId('veterinario_id')
                  ->constrained('veterinarios')
                  ->onDelete('restrict');

            $table->dateTime('fecha_consulta');
            $table->decimal('peso', 6, 2)->nullable();   // en kg
            $table->decimal('talla', 5, 2)->nullable();  // en cm
            $table->text('diagnostico')->nullable();
            $table->text('tratamiento')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};
