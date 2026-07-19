<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }

    /**
     * Actualiza la contraseña de cualquier usuario desde el panel de Admin.
     */
    public function adminUpdate(\Illuminate\Http\Request $request): \Illuminate\Http\RedirectResponse
    {
        // 1. Validar los datos ingresados
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
        ], [
            'email.exists' => 'No existe ningún usuario registrado con este correo.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        ]);

        // 2. Buscar al usuario por el correo del formulario
        $user = \App\Models\User::where('email', $request->email)->first();

        // 3. Actualizar su contraseña
        $user->update([
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
        ]);

        // 4. Regresar con un mensaje de éxito claro
        return back()->with('status', 'password-updated');
    }
}
