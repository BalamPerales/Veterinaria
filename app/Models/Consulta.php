<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $fillable = [
        'mascota_id',
        'veterinario_id',
        'fecha_consulta',
        'peso',
        'talla',
        'diagnostico',
        'tratamiento',
    ];

    protected $casts = [
        'fecha_consulta' => 'datetime',
        'peso' => 'decimal:2',
        'talla' => 'decimal:2',
    ];

    /**
     * Obtiene la mascota asociada a esta consulta.
     */
    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'mascota_id');
    }

    /**
     * Obtiene el veterinario que atendió esta consulta.
     */
    public function veterinario()
    {
        return $this->belongsTo(Veterinario::class, 'veterinario_id');
    }
}
