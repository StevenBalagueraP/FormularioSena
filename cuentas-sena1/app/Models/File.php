<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'file';
    protected $fillable = [
        'numero_ficha',
        'instructor_lider',
        'jornada',
        'horario',
        'ambiente',
        'dias_formacion'
    ];
    protected $casts =[
        'dias_formacion' => 'array',
    ];

    
}
