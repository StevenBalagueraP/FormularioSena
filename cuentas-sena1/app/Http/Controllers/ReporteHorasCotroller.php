<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReporteHorasCotroller extends Controller
{
public function index()
{
    return Inertia::render('ReporteHoras/Index', [
        'status'=>session('status'),
    ]);
}
}
