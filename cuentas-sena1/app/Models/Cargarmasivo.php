<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cargarmasivo extends Model
{
    // Nombre de la tabla
    protected $table = 'cargarmasivos';

    // Campos asignables
    protected $fillable = ['campo1', 'campo2']; // Cambia estos campos por los reales

    // Desactiva timestamps si no existen en la tabla
    public $timestamps = false;
}
