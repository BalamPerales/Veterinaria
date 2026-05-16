<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabla de configuración global de la clínica veterinaria.
     * Diseñada como registro singleton (un solo registro activo).
     */
    public function up(): void
    {
        Schema::create('configuracion_sistema', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_clinica');
            $table->text('mision')->nullable();
            $table->text('vision')->nullable();
            $table->text('valores')->nullable();
            $table->text('historia')->nullable();
            $table->json('precios_servicios')->nullable();
            $table->text('direccion_fisica')->nullable();
            $table->string('telefono_contacto', 30)->nullable();
            // URL externa del logo
            $table->string('logo_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('configuracion_sistema');
    }
};
