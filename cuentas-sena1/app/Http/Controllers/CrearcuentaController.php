<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Crearcuenta;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CrearcuentaController extends Controller
{
    public function index()
    {
        $helps=Crearcuenta::get(); // Obtiene todos los registros del modelo Cargarmasivo
        return Inertia::render('CargaMasivo/Crearcuenta', [
            'status' => session('status'),
            'helps' => $helps,
        ]);
    }
}