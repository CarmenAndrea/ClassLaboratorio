<?php

namespace App\Http\Controllers;

use App\Models\PasswordRequest;
use Illuminate\Http\Request;

class PasswordRequestController extends Controller
{
    // Guarda la solicitud (la envía el alumno/maestro)
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'Este correo no está registrado en el sistema.'
        ]);

        // Verificar si ya existe una solicitud pendiente
        $existe = PasswordRequest::where('email', $request->email)
            ->where('status', 'pendiente')
            ->exists();

        if ($existe) {
            return back()->with('status', 'Ya tienes una solicitud de restablecimiento pendiente.');
        }

        PasswordRequest::create([
            'email' => $request->email,
        ]);

        return back()->with('status', 'Tu solicitud ha sido enviada al Administrador con éxito.');
    }

    // El administrador elimina la solicitud una vez atendida
    public function destroy($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $solicitud = PasswordRequest::findOrFail($id);
        $solicitud->delete();

        return back()->with('status', 'Solicitud eliminada de la lista.');
    }
}