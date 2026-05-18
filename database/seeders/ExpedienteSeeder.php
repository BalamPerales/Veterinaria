<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dueno;
use App\Models\Mascota;
use App\Models\Consulta;
use App\Models\Veterinario;
use App\Models\User;

class ExpedienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Obtener o crear un veterinario de prueba
        $veterinario = Veterinario::first();
        if (!$veterinario) {
            $user = User::factory()->create([
                'name' => 'Dr. Veterinario',
                'email' => 'vet@prueba.com',
                'rol' => 'veterinario'
            ]);
            $veterinario = Veterinario::create([
                'usuario_id' => $user->id,
                'nombre_completo' => 'Dr. Veterinario Prueba',
                'especialidad' => 'Medicina General',
                'cedula_profesional' => 'VET-123456',
            ]);
        }

        // 2. Crear al dueño
        $dueno = Dueno::create([
            'nombre_completo' => 'Juan Pérez',
            'telefono' => '5551234567',
            'direccion' => 'Av. Siempre Viva 742, Springfield',
        ]);

        // 3. Crear a la mascota
        $mascota = Mascota::create([
            'dueno_id' => $dueno->id,
            'nombre' => 'Firulais',
            'especie' => 'Perro',
            'raza' => 'Mestizo / Criollo',
            'fecha_nacimiento' => '2020-05-15',
            'tipo_sangre' => 'DEA 1.1',
            'comportamiento' => 'Juguetón y dócil',
            'es_adoptado' => true,
        ]);

        // 4. Crear las dos consultas
        Consulta::create([
            'mascota_id' => $mascota->id,
            'veterinario_id' => $veterinario->id,
            'fecha_consulta' => now()->subDays(30),
            'peso' => 12.50,
            'talla' => 45.00,
            'diagnostico' => 'Checkup general inicial. El paciente se encuentra en excelentes condiciones de salud.',
            'tratamiento' => 'Continuar con alimentación estándar. Próxima revisión en 6 meses.',
        ]);

        Consulta::create([
            'mascota_id' => $mascota->id,
            'veterinario_id' => $veterinario->id,
            'fecha_consulta' => now(),
            'peso' => 12.80,
            'talla' => 45.00,
            'diagnostico' => 'Ligera dermatitis por contacto en la pata delantera derecha.',
            'tratamiento' => 'Limpieza con clorhexidina y aplicación de pomada cicatrizante cada 12 horas por 3 días.',
        ]);
    }
}
