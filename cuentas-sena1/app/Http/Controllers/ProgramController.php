<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProgramController extends Controller
{
    public function create()
    {
        return Inertia::render('Program/CreateProgram', [
            'programs' => Program::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'denominacion' => 'required|string',
            'codigo' => 'required|string|unique:programs',
            'version' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'etapa_lectiva' => 'required|integer|min:0',
            'etapa_productiva' => 'required|integer|min:0',
            'duracion_total' => 'required|integer|min:0',
            'titulo_certificado' => 'required|string',
            'justificacion' => 'required|string',
            'sectores' => 'required|string',
            'modalidad' => 'required|in:Presencial,Virtual,Mixta'
        ]);

        $program = Program::create($validated);

        return redirect()->back()->with('message', 'Programa creado exitosamente');
    }
}
