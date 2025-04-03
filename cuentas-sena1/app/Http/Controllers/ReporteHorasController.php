<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ReporteHorasController extends Controller
{
public function index()
{
    return Inertia::render('ReporteHoras/Index', [ 
        'status' => session('status'), 
    ]);
}
}
