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
        try {
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

            if (!$program) {
                throw new \Exception('Error al crear el programa');
            }

            return redirect()->back()->with('success', 'Programa creado exitosamente');
        } catch (\Exception $e) {
            \Log::error('Error creating program: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Error al crear el programa: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'denominacion' => 'required|string',
            'codigo' => 'required|string|unique:programs,codigo,' . $program->id,
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

        $program->update($validated);
        return redirect()->back();
    }

    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->back();
    }
}
