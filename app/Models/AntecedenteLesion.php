<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AntecedenteLesion extends Model
{
    use HasFactory;

    protected $table = 'antecedentes_lesiones';

    protected $fillable = [
        'mascota_id',
        'tipo_lesion',
    ];

    /**
     * Obtiene la mascota asociada a esta lesión.
     */
    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'mascota_id');
    }
}
