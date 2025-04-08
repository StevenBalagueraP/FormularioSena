<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ReportesController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/reportes', function () {
    return Inertia::render('Reportes/Disponibilidad');
})->name('reportes.disponibilidad');
Route::get('/asignacion', function () {
    return Inertia::render('Reportes/AsignacionTransversal');
})->name('reportes.asignacion');
Route::get('/horasmensuales', function () {
    return Inertia::render('Reportes/HorasMensuales');
})->name('reportes.horasmensuales');


require __DIR__.'/auth.php';
