<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                {{-- VISTA DEL ADMINISTRADOR --}}
                @if(auth()->user()->role === 'admin')
                    <div style="background-color: #f3e8ff; border: 2px solid #d8b4fe; padding: 24px; border-radius: 12px; margin-bottom: 24px;">
                        <h2 style="font-size: 24px; font-weight: bold; color: #581c87; margin-bottom: 8px;">Panel del Administrador ⚙️</h2>
                        <p style="color: #6b21a8; margin-bottom: 20px;">Desde aquí puedes gestionar el acceso a la plataforma y dar de alta nuevos usuarios.</p>
                        
                        <a href="/register" style="display: inline-block; background-color: #7e22ce; color: #ffffff; padding: 12px 24px; border-radius: 8px; font-weight: bold; text-decoration: none; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                            ➕ Registrar Nuevo Maestro o Alumno
                        </a>
                    </div>

                {{-- VISTA DEL MAESTRO --}}
                @elseif(auth()->user()->role === 'maestro')
                    
                    <h2 style="font-size: 24px; font-weight: bold; color: #4338ca; margin-bottom: 16px;">Panel del Profesor 👨‍🏫</h2>
                    
                    @if(session('success'))
                        <div style="background-color: #dcfce7; border: 2px solid #86efac; color: #15803d; padding: 12px 16px; border-radius: 8px; font-weight: bold; margin-bottom: 24px;">
                            ✅ {{ session('success') }}
                        </div>
                    @endif

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px;">
                        <!-- CREAR NUEVA CLASE -->
                        <div style="background-color: #eef2ff; padding: 20px; border-radius: 12px; border: 2px solid #c7d2fe;">
                            <h3 style="font-size: 18px; font-weight: bold; color: #1e1b4b; margin-bottom: 8px;">➕ Crear Nueva Clase</h3>
                            <p style="font-size: 14px; color: #475569; margin-bottom: 16px;">Escribe el nombre de la materia para abrir un nuevo salón.</p>
                            
                            <form action="{{ route('clases.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 12px;">
                                @csrf
                                <div>
                                    <input 
                                        type="text" 
                                        name="nombre" 
                                        placeholder="Ej. Programación Web" 
                                        style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; background-color: #ffffff; color: #0f172a;" 
                                        required
                                    >
                                </div>
                                <button type="submit" style="width: 100%; background-color: #4f46e5; color: #ffffff; font-weight: bold; padding: 10px; border-radius: 6px; border: none; cursor: pointer; font-size: 14px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                    Crear Clase
                                </button>
                            </form>
                        </div>

                        <!-- SUBIR TAREA -->
                        <div style="background-color: #f0fdf4; padding: 20px; border-radius: 12px; border: 2px solid #bbf7d0;">
                            <h3 style="font-size: 18px; font-weight: bold; color: #14532d; margin-bottom: 8px;">📤 Subir Tarea</h3>
                            <p style="font-size: 14px; color: #475569; margin-bottom: 16px;">Publica misiones o retos para tus alumnos.</p>
                            <button style="width: 100%; background-color: #16a34a; color: #ffffff; font-weight: bold; padding: 10px; border-radius: 6px; border: none; opacity: 0.6; cursor: not-allowed; font-size: 14px; margin-top: 32px;" disabled>
                                Próximamente...
                            </button>
                        </div>
                    </div>

                {{-- VISTA DEL ALUMNO --}}
                @else
                    
                    <h2 style="font-size: 24px; font-weight: bold; color: #ea580c; margin-bottom: 16px;">¡Hola, {{ auth()->user()->name }}! 🎒</h2>
                    <div style="background-color: #fff7ed; padding: 24px; border-radius: 12px; border: 3px dashed #fed7aa;">
                        <h3 style="font-size: 18px; font-weight: 900; color: #9a3412;">🚀 Tus Misiones Pendientes:</h3>
                        <ul style="margin-top: 16px; display: flex; flex-direction: column; gap: 8px; list-style: none; padding: 0;">
                            <li style="background-color: #ffffff; padding: 12px; border-radius: 6px; border-left: 4px solid #f97316; color: #1c1917; font-weight: 500;">
                                ✨ Tarea 1: Sumas Espaciales
                            </li>
                        </ul>
                    </div>

                @endif

            </div>
        </div>
    </div>
</x-app-layout>