<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Historial de alimentación por mascota.
     */
    public function up(): void
    {
        Schema::create('historial_alimentacion', function (Blueprint $table) {
            $table->id();

            $table->foreignId('mascota_id')
                  ->constrained('mascotas')
                  ->onDelete('cascade');

            $table->text('descripcion_dieta');
            // Número de veces que come al día (0-255)
            $table->unsignedTinyInteger('frecuencia_diaria');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historial_alimentacion');
    }
};
