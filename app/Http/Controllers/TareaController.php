<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'archivo' => 'nullable|file|mimes:pdf,png,jpg,jpeg,docx,zip|max:10240', // Máx 10MB
            'fecha_limite' => 'required|date',
            'estrellas_recompensa' => 'required|integer|min:1',
        ]);

        $rutaArchivo = null;
        if ($request->hasFile('archivo')) {
            $rutaArchivo = $request->file('archivo')->store('tareas_archivos', 'public');
        }

        Tarea::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'archivo' => $rutaArchivo,
            'fecha_limite' => $request->fecha_limite,
            'estrellas_recompensa' => $request->estrellas_recompensa,
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', '🚀 ¡Misión publicada con éxito para tus alumnos!');
    }
}