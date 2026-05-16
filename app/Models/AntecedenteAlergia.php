<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AntecedenteAlergia extends Model
{
    use HasFactory;

    protected $table = 'antecedentes_alergias';

    protected $fillable = [
        'mascota_id',
        'sustancia_alergena',
        'reaccion',
    ];

    /**
     * Obtiene la mascota asociada a esta alergia.
     */
    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'mascota_id');
    }
}
