<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    use HasFactory;

    protected $fillable = [
        'dueno_id',
        'nombre',
        'especie',
        'raza',
        'fecha_nacimiento',
        'tipo_sangre',
        'comportamiento',
        'es_adoptado',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'es_adoptado' => 'boolean',
    ];

    /**
     * Obtiene el dueño de la mascota.
     */
    public function dueno()
    {
        return $this->belongsTo(Dueno::class, 'dueno_id');
    }

    /**
     * Obtiene las consultas de esta mascota.
     */
    public function consultas()
    {
        return $this->hasMany(Consulta::class, 'mascota_id');
    }

    /**
     * Obtiene los antecedentes de alergias de esta mascota.
     */
    public function antecedentesAlergias()
    {
        return $this->hasMany(AntecedenteAlergia::class, 'mascota_id');
    }

    /**
     * Obtiene los antecedentes de lesiones de esta mascota.
     */
    public function antecedentesLesiones()
    {
        return $this->hasMany(AntecedenteLesion::class, 'mascota_id');
    }

    /**
     * Obtiene los antecedentes patológicos de esta mascota.
     */
    public function antecedentesPatologicos()
    {
        return $this->hasMany(AntecedentePatologico::class, 'mascota_id');
    }

    /**
     * Obtiene el historial de alimentación de esta mascota.
     */
    public function historialAlimentacion()
    {
        return $this->hasMany(HistorialAlimentacion::class, 'mascota_id');
    }
}
