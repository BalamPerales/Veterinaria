<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabla de mascotas. Pertenece a un dueño.
     */
    public function up(): void
    {
        Schema::create('mascotas', function (Blueprint $table) {
            $table->id();

            // FK → duenos
            $table->foreignId('dueno_id')
                  ->constrained('duenos')
                  ->onDelete('cascade');

            $table->string('nombre');
            $table->string('especie', 100);
            $table->string('raza', 100)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('tipo_sangre', 20)->nullable();
            $table->string('comportamiento')->nullable();
            $table->boolean('es_adoptado')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mascotas');
    }
};
