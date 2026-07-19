<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- TU PANEL DE ADMINISTRADOR --}}
            @if(auth()->user()->role === 'admin')
                <div style="background-color: #f3e8ff; border: 2px solid #d8b4fe; padding: 24px; border-radius: 12px; margin-bottom: 24px;">
                    <h2 style="font-size: 24px; font-weight: bold; color: #581c87; margin-bottom: 8px;">Panel del Administrador ⚙️</h2>
                    <p style="color: #6b21a8; margin-bottom: 20px;">Desde aquí puedes gestionar el acceso a la plataforma y dar de alta nuevos usuarios.</p>
                    
                    <a href="/register" style="display: inline-block; background-color: #7e22ce; color: #ffffff; padding: 12px 24px; border-radius: 8px; font-weight: bold; text-decoration: none; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); margin-bottom: 24px;">
                        ➕ Registrar Nuevo Maestro o Alumno
                    </a>

                    <hr style="border: 0; border-top: 1px solid #d8b4fe; margin-bottom: 24px;">

                    <!-- FORMULARIO PARA REESTABLECER CONTRASEÑA -->
                    <div style="background-color: #eff6ff; border: 2px solid #bfdbfe; padding: 20px; border-radius: 10px; max-width: 450px;">
                        <h3 style="font-size: 18px; font-weight: bold; color: #1e3a8a; margin-bottom: 6px;">🔑 Cambiar Contraseña de un Usuario</h3>
                        <p style="font-size: 14px; color: #1e40af; margin-bottom: 16px;">Ingresa el correo del alumno o maestro para asignarle una nueva clave directamente.</p>

                        @if(session('status') == 'password-updated')
                            <div style="background-color: #dcfce7; color: #16a34a; padding: 10px; border-radius: 6px; font-weight: bold; margin-bottom: 12px; font-size: 14px;">
                                ✅ ¡Contraseña actualizada con éxito!
                            </div>
                        @endif

                        @if ($errors->any())
                            <div style="background-color: #ffeeef; color: #dc2626; padding: 10px; border-radius: 6px; font-weight: bold; margin-bottom: 12px; font-size: 14px;">
                                ❌ {{ $errors->first() }}
                            </div>
                        @endif

                        <form action="{{ route('admin.password.update') }}" method="POST" style="display: flex; flex-direction: column; gap: 12px;">
                            @csrf

                            <div>
                                <label style="display: block; font-size: 13px; font-weight: bold; color: #1e3a8a; margin-bottom: 4px;">Correo del Usuario:</label>
                                <input type="email" name="email" placeholder="ejemplo@correo.com" style="width: 100%; padding: 8px; border: 1px solid #93c5fd; border-radius: 6px; font-size: 14px; color: #0f172a;" required>
                            </div>

                            <div>
                                <label style="display: block; font-size: 13px; font-weight: bold; color: #1e3a8a; margin-bottom: 4px;">Nueva Contraseña:</label>
                                <input type="password" name="password" placeholder="Mínimo 8 caracteres" style="width: 100%; padding: 8px; border: 1px solid #93c5fd; border-radius: 6px; font-size: 14px; color: #0f172a;" required>
                            </div>

                            <div>
                                <label style="display: block; font-size: 13px; font-weight: bold; color: #1e3a8a; margin-bottom: 4px;">Confirmar Nueva Contraseña:</label>
                                <input type="password" name="password_confirmation" placeholder="Repite la contraseña" style="width: 100%; padding: 8px; border: 1px solid #93c5fd; border-radius: 6px; font-size: 14px; color: #0f172a;" required>
                            </div>

                            <button type="submit" style="background-color: #2563eb; color: #ffffff; font-weight: bold; padding: 10px; border-radius: 6px; border: none; cursor: pointer; font-size: 14px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-top: 4px;">
                                Actualizar Contraseña
                            </button>
                        </form>
                    </div>
                </div>
            @endif

            {{-- SI TIENES MÁS CONTENIDO PROPIO ABAJO (TABLAS, CLASES, ETC.), PUEDES PONERLO AQUÍ --}}

        </div>
    </div>
</x-app-layout>