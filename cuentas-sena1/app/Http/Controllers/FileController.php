<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\File;
use Inertia\Inertia;

class FileController extends Controller
{ 
    public function index()
    {
        $files=File::get();
        return Inertia::render('File/Index', [
            'status' => session('status'),
            'files' => $files,

        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'numero_ficha' => 'required|string|max:20',
            'instructor_lider' => 'required|string',
            'jornada' => 'required|string',
            'horario' => 'required|string',
            'ambiente' => 'required|string',
            'dias_formacion' => 'required',
        ]);
    
        File::create($request->all());

    // Validar los datos recibidos del formulario
    $validated = $request->validate([
        'numero_ficha' => 'nullable|string|max:20',
        'instructor_lider' => 'required|string|max:255',
        'jornada' => 'required|in:mañana,tarde,noche,mixta',
        'horario' => 'required|string|max:255',
        'ambiente' => 'required|string|max:255',
        'dias_formacion' => 'required|array',
    ]);
    File::create([
        'numero_ficha' => $validated['numero_ficha'],
        'instructor_lider' => $validated['instructor_lider'],
        'jornada' => $validated['jornada'],
        'horario' => $validated['horario'],
        'ambiente' => $validated['ambiente'],
        'dias_formacion' => json_encode($validated['dias_formacion']),
    ]);//crear registro en bd

    return redirect()->back()->with('status', 'El registro fue creado exitosamente.');
}
}
