<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Crea el usuario administrador del sistema.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@veterinaria.com'],
            [
                'name'     => 'admin',
                'email'    => 'admin@veterinaria.com',
                'password' => Hash::make('admin'),
                'rol'      => 'administrador',
            ]
        );

        User::updateOrCreate(
            ['email' => 'vet@gmail.com'],
            [
                'name'     => 'veterinario',
                'email'    => 'vet@gmail.com',
                'password' => Hash::make('veterinario'),
                'rol'      => 'veterinario',
            ]
        );
    }
}
