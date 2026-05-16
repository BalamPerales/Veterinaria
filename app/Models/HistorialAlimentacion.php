<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialAlimentacion extends Model
{
    use HasFactory;

    protected $table = 'historial_alimentacion';

    protected $fillable = [
        'mascota_id',
        'descripcion_dieta',
        'frecuencia_diaria',
    ];

    /**
     * Obtiene la mascota asociada a este historial.
     */
    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'mascota_id');
    }
}
