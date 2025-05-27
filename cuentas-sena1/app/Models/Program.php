<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'denominacion',
        'codigo',
        'version',
        'fecha_inicio',
        'fecha_fin',
        'etapa_lectiva',
        'etapa_productiva',
        'duracion_total',
        'titulo_certificado',
        'justificacion',
        'sectores',
        'modalidad'
    ];
}
