<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competencia extends Model
{
    protected $fillable = [
        'competencia',
        'norma',
        'codigo',
        'nombre',
        'duracionMaxima'
    ];

    // Relación: una competencia tiene muchos resultados
    public function resultados()
    {
        return $this->hasMany(Resultado::class, 'competencia_id');
    }
}
