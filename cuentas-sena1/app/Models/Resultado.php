<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
    protected $primaryKey = 'idResultado'; // porque definiste la clave así en la migración

    protected $fillable = [
        'competencia_id',
        'nombreResultado'
    ];

    // Relación: un resultado pertenece a una competencia
    public function competencia()
    {
        return $this->belongsTo(Competencia::class, 'competencia_id');
    }
}
