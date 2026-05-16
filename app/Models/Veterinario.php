<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veterinario extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'nombre_completo',
        'especialidad',
        'cedula_profesional',
        'foto_firma',
    ];

    /**
     * Obtiene el usuario asociado a este veterinario.
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    /**
     * Obtiene las consultas atendidas por este veterinario.
     */
    public function consultas()
    {
        return $this->hasMany(Consulta::class, 'veterinario_id');
    }
}
