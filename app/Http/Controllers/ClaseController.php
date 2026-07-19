<?php

namespace App\Http\Controllers;

use App\Models\Clase;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClaseController extends Controller
{
    // Crear una clase (Vista del Maestro)
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        Clase::create([
            'nombre' => $request->nombre,
            'codigo_acceso' => strtoupper(Str::random(6)), // Genera código de 6 letras/números
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', '¡Clase creada correctamente!');
    }

    // Unirse a una clase (Vista del Alumno)
    public function unirse(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|exists:clases,codigo_acceso',
        ], [
            'codigo.exists' => 'El código ingresado no pertenece a ninguna clase activa.',
        ]);

        $clase = Clase::where('codigo_acceso', $request->codigo)->first();

        // Vinculamos al alumno con la clase
        auth()->user()->clases()->syncWithoutDetaching([$clase->id]);

        return redirect()->back()->with('success', "¡Te has inscrito correctamente a {$clase->nombre}!");
    }
}