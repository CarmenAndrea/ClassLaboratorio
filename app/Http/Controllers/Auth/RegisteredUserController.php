<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
   public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'role' => ['required', 'string'],
    ]);

    // Forzamos a que guarde exactamente lo que viene del formulario
    $role = $request->role; 

    // Si eligió maestro, validamos la licencia de forma estricta
    if ($role === 'maestro') {
        // Usamos trim() para quitar espacios vacíos por si acaso
        if (trim($request->licencia) !== 'MAESTRO2024') {
            // Si la licencia está mal, detenemos todo y mandamos el error a la pantalla
            return back()->withErrors(['licencia' => 'El código de licencia es incorrecto.'])->withInput();
        }
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $role, // Se guarda el rol seleccionado ('maestro' o 'alumno')
    ]);

    event(new Registered($user));

    Auth::login($user);

    return redirect(route('dashboard', absolute: false));
}
}
