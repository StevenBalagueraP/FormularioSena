<?php
namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class ReportesController extends Controller
{
    public function index()
    {
        return Inertia::render('Reportes/Availability', [
            'status' => session('status'),
            'events' => [
                ['title' => 'Disponible', 'start' => '2025-04-01', 'color' => 'green'],
                ['title' => 'Ocupado', 'start' => '2025-04-02', 'color' => 'red'],
            ],
        ]);
    }
    
}
