<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Crearcuenta extends Model
{
    // Nombre de la tabla
    protected $table = 'crearcuenta';

    // Campos asignables
    protected $fillable = ['juan', 'valdez']; // Cambia estos campos por los reales

    // Desactiva timestamps si no existen en la tabla
    public $timestamps = false;
}