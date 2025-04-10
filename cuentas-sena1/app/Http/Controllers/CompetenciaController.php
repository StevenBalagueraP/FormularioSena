<?php

namespace App\Http\Controllers;

use App\Models\Competencia;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CompetenciaController extends Controller
{
    public function index()
    {
        $competencias = Competencia::with('resultados')->get();

        return Inertia::render('Program/CompetenciasResultados', [
            'competencias' => $competencias
        ]);
    }
}
