<?php

use App\Http\Controllers\ClaseController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\PasswordRequestController; 

// Vista de bienvenida principal
Route::get('/', function () {
    return view('welcome');
});

// Panel de administración: Carga las solicitudes pendientes para el Dashboard
Route::get('/dashboard', function () {
    $solicitudes = \App\Models\PasswordRequest::where('status', 'pendiente')
        ->orderBy('created_at', 'desc')
        ->get();
        
    return view('dashboard', compact('solicitudes'));
})->middleware(['auth', 'verified'])->name('dashboard');

// Registro de clases
Route::post('/clases', [ClaseController::class, 'store'])->name('clases.store')->middleware('auth');

// Rutas de perfil del usuario estructuradas por Breeze
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas de autenticación por defecto de Laravel Breeze
require __DIR__.'/auth.php';

// Actualización manual de contraseñas por parte del Administrador
Route::post('/admin/update-password', [PasswordController::class, 'adminUpdate'])
    ->name('admin.password.update')
    ->middleware('auth');



// Ruta pública para enviar alertas desde el Login (Es la que busca tu vista)
Route::post('/password-request', [PasswordRequestController::class, 'store'])
    ->name('admin.password.request');

// Ruta para que el Admin elimine o limpie las solicitudes atendidas
Route::delete('/password-request/{id}', [PasswordRequestController::class, 'destroy'])
    ->name('password.request.destroy')
    ->middleware('auth');
    use App\Http\Controllers\TareaController;

Route::post('/tareas', [TareaController::class, 'store'])->name('tareas.store');