<?php

namespace App\Http\Controllers;

use App\Models\Clase;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClaseController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        Clase::create([
            'nombre' => $request->nombre,
            'codigo_acceso' => strtoupper(Str::random(6)), // Código aleatorio de 6 letras
            'user_id' => auth()->id(), // ID del maestro logueado
        ]);

        return back()->with('success', '¡Clase creada con éxito!');
    }
}